<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\component\DXConst;
use app\component\UploadHandler;
use app\component\WebUser;
use yii\helpers\Url;
use app\models\LoginForm;


class UserController extends BaseController
{
    public function actionLoginAjax()
    {
        $this->checkParams(['username', 'password']);

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $data['code'] = 0;

        $model = new LoginForm();
        $model->username = $username;
        $model->password = $password;
        if ($model->login())
        {
            $data['code'] = 0;
        }          
        else
        {
            $data['code'] = 1;
        }

        $this->finish($data);
    }

    public function actionLogout()
    {
        app()->user->logout();        
        $this->redirect('/');
    }    
}