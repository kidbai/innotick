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

class BaseController extends Controller
{
    public $redis;

    public function beforeAction($action)
    {
        $ok = parent::beforeAction($action);

        return $ok;
    }

    public function finish($data)
    {
        header('Content-type:application/json;charset=UTF-8');

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
