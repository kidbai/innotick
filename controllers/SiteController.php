<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Process;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $this->redirect('/admin/index');
    }

    public function actionDownload()
    {
        return $this->render('index');
    }

    public function actionCallback()
    {
        call_user_func(function () {
            dump($this);
        });
    }

    public function actionTest()
    {
        dump(strlen('ddd'));
    }

    public function actionPassword()
    {
        dump(md5(md5('123456')));
    }

    public function actionModule()
    {
        $module[] = ['type' => 1, 'id' => 1, 'name' => '问卷1', 'time' => 3];
        $module[] = ['type' => 2, 'id' => 1, 'name' => '投票1', 'time' => 5];
        $module[] = ['type' => 3, 'id' => 1, 'name' => '会前阅读', 'time' => 5];

        echo json_encode($module);
        die();
    }

    public function actionQuestion()
    {
        // $option[] = ['id' => 1, 'content' => '佛教'];
        // $option[] = ['id' => 2, 'content' => '基督教'];
        // $option[] = ['id' => 3, 'content' => '伊斯兰教'];

        // $option[] = ['id' => 1, 'content' => '积极乐观的时候'];
        // $option[] = ['id' => 2, 'content' => '悲观失望的时候'];
        // $option[] = ['id' => 3, 'content' => '无聊的时候'];        
        // $option[] = ['id' => 4, 'content' => '孤独困惑的时候'];        

        // $option[] = ['id' => 1, 'content' => '系统化理论化的世界观'];
        // $option[] = ['id' => 2, 'content' => '对具体科学知识加以概括、总结和反思的产物'];
        // $option[] = ['id' => 3, 'content' => '世界万物尤其是人类自身存在的本质、规律和意义'];        
        // $option[] = ['id' => 4, 'content' => '方法论'];  
        
        $option[] = ['user_id' => 5, 'username' => '毛泽东'];            

        die(json_encode($option));
    }

    public function actionOption()
    {
        $option[] = ["content" => "test"];

        echo json_encode($option);
        die();
    }   


    public function actionPass()
    {
        dump(md5(md5('7')));

        dump(md5('6'));
    }

    public function actionProcess()
    {
        $process_list = Process::find()->all();
        foreach ($process_list as $process)
        {
            if ($process->type >= 10000)
            {
                $process->type -= 10000;
                $process->save();
            }
        }
    }



}
