<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\component\DXConst;
use app\component\UploadHandler;
use app\component\WebUser;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\PostFavourite;
use app\models\Post;
use app\models\PostComment;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;


class UserController extends BaseController
{
    public $layout = 'main';
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
    
    public function actionUserSave()
    {
       $data_info = ($_REQUEST['data']); 
       user()->email = $data_info['email'];
       user()->name = $data_info['name'];
       user()->phone = $data_info['phone'];
       user()->province = $data_info['province'];
       user()->city = $data_info['city'];
       user()->county = $data_info['county'];
       user()->desc = $data_info['desc'];
       user()->url = $data_info['url'];
       user()->avatar = $data_info['avatar'];
       user()->gender = intval($data_info['gender']);
       // dump($data_info['gender']);
       $data = user()->attributes;
        if(!user()->save())
        {
           $this->finishError(-5,'save action error', user()->errors);
        } 
      
       $this->finish($data);
    }

    public function actionFavoritePost()
    {
        $user_id = user()->id;

        $query = new ActiveQuery(PostFavourite::className());
        $query->andWhere(['user_id' => $user_id]);
        $query->orderBy(['created' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('/user/collection', ['provider' => $provider]);
    }

    

    public function actionCollection()
    {
        return $this->render('/user/collection');
    }
    public function actionInfo()
    {
        return $this->render('/user/info');
    }

  

}