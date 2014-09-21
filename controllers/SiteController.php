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
    public $layout = 'main';

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
        return $this->render('/site/index');
    }

    public function actionPost()
    {
        return $this->render('/site/post');
    }

    public function actionCalColumn()
    {
        dump(sprintf("%.8f", 80.0 / 1200));
        dump(sprintf("%.8f", 160.0 / 1200));
        dump(sprintf("%.8f", 240.0 / 1200));
        dump(sprintf("%.8f", 320.0 / 1200));
        dump(sprintf("%.8f", 400.0 / 1200));
        dump(sprintf("%.8f", 480.0 / 1200));
        dump(sprintf("%.8f", 560.0 / 1200));
        dump(sprintf("%.8f", 640.0 / 1200));
        dump(sprintf("%.8f", 720.0 / 1200));
        dump(sprintf("%.8f", 800.0 / 1200));
        dump(sprintf("%.8f", 880.0 / 1200));
        dump(sprintf("%.8f", 960.0 / 1200));
        dump(sprintf("%.8f", 1040.0 / 1200));
        dump(sprintf("%.8f", 1120.0 / 1200));
        dump(sprintf("%.8f", 1200.0 / 1200));
        die();
    }

}
