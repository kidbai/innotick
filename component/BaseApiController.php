<?php

namespace app\component;

use Yii;
use yii\web\Controller;
use app\models\Token;
use app\models\User;
use app\models\Msg;
use app\models\PostAction;
use app\models\Process;
use app\models\Answer;
use app\models\Action;
use app\models\Message;
use app\component\DXConst;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Predis\Client;

class BaseApiController extends Controller
{
	public $params;

	public $user_id;
    public $client;
    public $version;
    public $token;

    public $redis;

    public function beforeAction($action)
    {
    	header('Content-type:application/json;charset=UTF-8');

        $ok = parent::beforeAction($action);

    	foreach ($_REQUEST as $key => $value) 
    	{
    		$this->params[$key] = $value;
    	}

        $this->checkParams(['client', 'version']);

        $this->client = intval($this->params['client']);
        $this->version = intval($this->params['version']);

        $data = ['code' => 0, 'message' => 'ok'];

        if (!($this->client >= 1 && $this->client <= 3))
        {
            $data['code'] = DXConst::ERROR_WRONG_TYPE;
            $data['message'] = 'wrong client';
            $this->finish($data);
        }        

    	$action = $this->action->id;
    	$controler = $this->action->controller->id;
    	if ($controler == 'api' && in_array($action, ['user-login', 'meeting-current', 'meeting-member']))
    	{
    		return true;
    	}

    	// check token

    	if (!isset($this->params['token']))
    	{
    		$data['code'] = DXConst::ERROR_PARAM_NOT_SET;
    		$data['message'] = 'token is not set';
    		$this->finish($data);
    	}

    	$token = $this->params['token'];
    	$tokenData = sql(' select * from {{%token}} where token = :token and status = :status ')
    					->bindValues([
                            ':token' => $token, 
                            ':status' => DXConst::TOKEN_STATUS_VALID])
    					->queryOne();
    	if (!$tokenData)
    	{
    		$data['code'] = DXConst::ERROR_TOKEN_INVALID;
    		$data['message'] = 'token invalid';
    		$this->finish($data);
    	}

    	sql(' update {{%token}} set updated = :updated where id = :id ')->bindValues([':updated' => time(), ':id' => intval($tokenData['id'])])->query();


    	// prepare base data
    	
        $this->user_id = intval($tokenData['user_id']);
        $this->token = $token;

        return $ok;
    }

    public function checkParams($requiredParams)
    {
        foreach ($requiredParams as $p)
        {
            if (!isset($this->params[$p]))
            {
            	$error = [];
                $error['code'] = DXConst::ERROR_PARAM_NOT_SET;
                $error['message'] = 'param ' . $p . ' not set';
                $this->finish($error);
            }
        }
    }

    public function finish($data)
    {
    	die(json_encode($data));
    }

    public function redis()
    {
        if ($this->redis != null) return $this->redis;

        $this->redis = new Client([
                            'scheme' => 'tcp',
                            'host'   => 'zhmeeting',
                            'port'   => 6379,
                        ]);

        return $this->redis;
    }    

    public function saveMeetingProcess($meeting_id, $type, $user_id, $process_data)
    {
        $data['code'] = 0;

        $process = new Process();
        $process->type = $type;       
        $process->meeting_id = $meeting_id;
        $process->user_id = $user_id;
        $process->created = time();
        $process->data = $process_data;
        if ($process->save())
        {   
            $data = $this->saveMeetingMessage($meeting_id, DXConst::MESSAGE_PROCESS_BASE + $type, $user_id, 0, $process->data);   
        }
        else
        {
            $data['code'] = DXConst::ERROR_MODEL_ERROR;
            $data['message'] = 'save process error';
        }

        return $data;
    }

    public function saveMeetingMessage($meeting_id, $message_type, $from_user_id, $to_user_id, $message_data)
    {
        $data['code'] = 0;

        $msg = new Message();
        $msg->meeting_id = $meeting_id;
        $msg->type = $message_type;
        $msg->from_user_id = $from_user_id;
        $msg->to_user_id = $to_user_id;
        $msg->data = $message_data;
        $msg->created = time();
        if ($msg->save())
        {
            $m = $msg->attributes;
            $this->publishMeetingMessage($meeting_id, json_encode($m));
        } 
        else
        {
            $data['code'] = DXConst::ERROR_MODEL_ERROR;
            $data['message'] = 'save message error';
        }

        return $data;
    }


    public function publishMessage($routing_key, $msg)
    {
        $connection = new AMQPConnection('zhmeeting', 5672, 'zhmeeting', 'zhmeeting', 'zhmeeting');
        $channel = $connection->channel();
        
        $exchange_name = "message.event";
        // $routing_key = "user.$to_user_id.chat";

        $channel->exchange_declare($exchange_name, 'topic', false, true, false);

        $amqp_msg = new AMQPMessage($msg, ['delivery_mode' => 2]);
        $channel->basic_publish($amqp_msg, $exchange_name, $routing_key);

        $channel->close();
        $connection->close();
    }	

    public function publishMeetingMessage($meeting_id, $msg)
    {
        $connection = new AMQPConnection('zhmeeting', 5672, 'zhmeeting', 'zhmeeting', 'zhmeeting');
        $channel = $connection->channel();
        
        $exchange_name = "message.event";

        $channel->exchange_declare($exchange_name, 'topic', false, true, false);

        $members = $this->getMeetingMember($meeting_id);
        foreach ($members as $member)
        {
            $routing_key = 'user.'. $member .'.msg';
            $amqp_msg = new AMQPMessage($msg, ['delivery_mode' => 2]);
            $channel->basic_publish($amqp_msg, $exchange_name, $routing_key);
        }

        $channel->close();
        $connection->close();        
    }

    public function getMeetingHost($meeting_id)
    {
        $redis = $this->redis();

        $key = "meeting.$meeting_id.host";

        $host_id = $redis->get($key);
        if (!$host_id)
        {
            $host_id = sql('select user_id from {{%meeting_member}} where meeting_id = '. $meeting_id .' and type = '. DXConst::MEETING_MEMBER_HOST .' ')->queryScalar();
            if ($host_id)
            {
                $redis->set($key, $host_id);
                return intval($host_id);
            }
        }
        else
        {
            return intval($host_id);
        }

        return 0;

    }

    // common function start

    public function getMeetingMember($meeting_id)
    {
        $redis = $this->redis();

        $key = "meeting.$meeting_id.member";

        $members = $redis->smembers($key);
        if (!$members)
        {
            $members = [];
            $db_member_list = sql(' select user_id from {{%meeting_member}} where meeting_id = '. $meeting_id .' ')->queryAll();
            if ($db_member_list)
            {
                foreach ($db_member_list as $db_member)
                {
                    $user_id = intval($db_member['user_id']);
                    $members[] = $user_id;
                    $redis->sadd($key, $user_id);
                }
            }
        }

        return $members;
    }  

    public function saveRate($meeting_id, $action_type, $from_user_id, $to_user_id, $content)
    {
        // save rate content to p1 in tbl_action

        $data['code'] = 0;

        $action = new Action();
        $action->meeting_id = $meeting_id;
        $action->type = $action_type;
        $action->from_user_id = $from_user_id;
        $action->to_user_id = $to_user_id;
        $action->p1 = $content;
        $action->created = time();
        if (!$action->save())
        {
            $data['code'] = DXConst::ERROR_MODEL_ERROR;
        }
        else
        {
            $d = ['type' => $action_type, 'content' => $content];

            // target user stat
            $d['rate_count'] = sql(' select count(*) from {{%action}} where meeting_id = :meeting_id and to_user_id = :to_user_id and (type = :type_common || type = :type_meeting || type = :type_emotion) ')
                            ->bindValues([':meeting_id' => $meeting_id, ':to_user_id' => $to_user_id, 
                                          ':type_common' => DXConst::ACTION_RATE_COMMON, ':type_meeting' => DXConst::ACTION_RATE_MEETING, ':type_emotion' => DXConst::ACTION_RATE_EMOTION])
                            ->queryScalar(); 
            $db_action_stat = sql(' select to_user_id, count(*) as count from {{%action}} where meeting_id = :meeting_id and (type = :type_common || type = :type_meeting || type = :type_emotion) group by to_user_id order by count desc ')
                            ->bindValues([':meeting_id' => $meeting_id, ':type_common' => DXConst::ACTION_RATE_COMMON, ':type_meeting' => DXConst::ACTION_RATE_MEETING, ':type_emotion' => DXConst::ACTION_RATE_EMOTION])
                            ->queryAll();
            $i = 0;
            for (; $i < count($db_action_stat); $i++)
            {
                $row = $db_action_stat[$i];
                if (intval($row['to_user_id']) == intval($to_user_id))
                {
                    break;
                }
            }
            $d['rate_count_rank'] = $i + 1;

            $this->saveMessage($meeting_id, DXConst::MESSAGE_NOTIFY, $from_user_id, $to_user_id, json_encode($d));
        }

        // from user stat
        $data['rate_count'] = sql(' select count(*) from {{%action}} where meeting_id = :meeting_id and from_user_id = :from_user_id and (type = :type_common || type = :type_meeting || type = :type_emotion) ')
                        ->bindValues([':meeting_id' => $meeting_id, ':from_user_id' => $from_user_id, 
                                      ':type_common' => DXConst::ACTION_RATE_COMMON, ':type_meeting' => DXConst::ACTION_RATE_MEETING, ':type_emotion' => DXConst::ACTION_RATE_EMOTION])
                        ->queryScalar(); 
        $db_action_stat = sql(' select from_user_id, count(*) as count from {{%action}} where meeting_id = :meeting_id and (type = :type_common || type = :type_meeting || type = :type_emotion) group by from_user_id order by count desc ')
                        ->bindValues([':meeting_id' => $meeting_id, ':type_common' => DXConst::ACTION_RATE_COMMON, ':type_meeting' => DXConst::ACTION_RATE_MEETING, ':type_emotion' => DXConst::ACTION_RATE_EMOTION])
                        ->queryAll();
        $i = 0;
        for (; $i < count($db_action_stat); $i++)
        {
            $row = $db_action_stat[$i];
            if (intval($row['from_user_id']) == intval($from_user_id))
            {
                break;
            }
        }
        $data['rate_count_rank'] = $i + 1;        

        return $data;
    }  

    public function saveMessage($meeting_id, $type, $from_user_id, $to_user_id, $message_data)
    {
        $data['code'] = 0;

        $msg = new Message();
        $msg->meeting_id = $meeting_id;
        $msg->type = $type;
        $msg->from_user_id = $from_user_id;
        $msg->to_user_id = $to_user_id;
        $msg->data = $message_data;
        $msg->created = time();
        if ($msg->save())
        {
            $m = $msg->attributes;
            $this->publishMessage("user.$to_user_id.message", json_encode($m));
        } 
        else
        {
            $data['code'] = DXConst::ERROR_MODEL_ERROR;
            $data['message'] = 'send message fail';
        }

        return $data;
    }     



}
