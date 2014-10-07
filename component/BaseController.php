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

    public function finishError($code, $message, $extra = [])
    {
        $data['code'] = intval($code);
        $data['message'] = $message;
        if (is_array($extra))
        {
            $data = array_merge($data, $extra);
        }
        
        $this->finish($data);
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

    public function checkParams($requiredParams)
    {
        foreach ($requiredParams as $p)
        {
            if (!isset($_REQUEST[$p]))
            {
                $error = [];
                $error['code'] = DXConst::ERROR_PARAM_NOT_SET;
                $error['message'] = 'param ' . $p . ' not set';
                $this->finish($error);
            }
        }
    }          
}
