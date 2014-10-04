<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\models\LoginForm;
use app\models\Admin;
use app\models\Post;
use app\models\User;
use app\models\Meeting;
use app\models\MeetingAgenda;
use app\models\Questionnaire;
use app\models\Question;
use app\models\Vote;
use app\component\WebUser;
use app\component\DXConst;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class AdminController extends BaseController
{
    public $layout = 'admin';

    public function beforeAction($action)
    {
        if (app()->admin->isGuest)
        {
            if ($action->id != 'login')
            {
                $this->redirect('/admin/login');
            }
        }
        else
        {
            if ($action->id == 'login')
            {
                $this->redirect('/admin/index');
            }
        }

        

        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionStatus()
    {

    }

    public function actionLogin()
    {
        $this->layout = 'todc';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->login(WebUser::TYPE_ADMIN))
            {
                $this->redirect('/admin/index');
            }          
        }       
        
        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        app()->admin->logout();        
        $this->redirect('/admin/login');
    }

    public function actionIndex()
    {
        // return  $this->render('/admin/index');

        $this->redirect('/admin/post');
    }

    public function actionUserInfo()
    {
        $user = ['error' => 0];

        $user['username'] = admin()->username;

        $this->finish($user);
    }     

    public function actionChangePassword()
    {
        $old_password = $_REQUEST['old_password'];
        $password = $_REQUEST['password'];

        if (admin()->password != admin()->encodePassword($old_password))
        {
            $this->finish(['error' => 1, 'message' => '旧密码错误']);
        }

        admin()->password = admin()->encodePassword($password);
        if (admin()->save())
        {
            $this->finish(['error' => 0, 'message' => '修改密码成功']);
        }
        else
        {
            $this->finish(['error' => 1, 'message' => '修改失败，请稍后再试']);
        }
    }    









    public function actionPost()
    {
        $this->redirect('/admin/post-list');
    }

    public function actionPostList($category_id = 1)
    {
        app()->session['page'] = 1;

        $category_id = intval($category_id);
        $category = getCategory();
        if (!in_array($category_id, array_keys($category)))
        {
            throw new NotFoundHttpException('类别不存在');
        }

        $query = new ActiveQuery(Post::className());
        $query->andWhere(['category_id' => $category_id]);
        $query->orderBy(['id' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);        

        return $this->render('/admin/post-list', ['category' => $category, 'category_id' => $category_id, 'provider' => $provider]);
    }

    public function actionPostEdit($id = 0, $category_id = 0)
    {
        app()->session['page'] = 1;

        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();
        if (!$post)
        {
            $post = new Post();
        }
        else
        {
            $category_id = intval($post->category_id);
        }
        $category = getCategory();
        if ($post->load(app()->request->post()))
        {
            if ($post->status < 1)
            {
                $post->status = Post::STATUS_ON;
            }
            $post->user_id = admin()->id;
            if ($post->save()) 
            {
                $this->redirect(url(['/admin/post-list', 'category_id' => $post->category_id]));
            }       
        }          

        return $this->render('/admin/post-edit', ['category' => $category, 'model' => $post, 'category_id' => $category_id]);
    }


    public function actionPostDelete()
    {
        $id = intval($_REQUEST['id']);

        $data = ['code' => 0];

        $count = Post::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['code'] = 1;
        }

        $this->finish($data);
    }          
    
}
