<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Post;

class PostController extends Controller
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

    public function actionView($id)
    {
        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();

        return $this->render('/post/view', ['post' => $post]);
    }

}
