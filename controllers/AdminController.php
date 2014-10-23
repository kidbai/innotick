<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use app\models\LoginForm;
use app\models\Admin;
use app\models\Post;
use app\models\PostComment;
use app\models\PostAction;
use app\models\User;
use app\models\Meeting;
use app\models\MeetingAgenda;
use app\models\Questionnaire;
use app\models\Question;
use app\models\Vote;
use app\models\Config;
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

    public function actionPostList($category_id = 0)
    {
        app()->session['page'] = 1;

        $category_id = intval($category_id);
        $category = getCategory();
        if ($category_id != 0 && !in_array($category_id, array_keys($category)))
        {
            throw new NotFoundHttpException('类别不存在');
        }

        $query = new ActiveQuery(Post::className());
        if ($category_id != 0)
        {
            $query->andWhere(['category_id' => $category_id]);
        }

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

    public function actionPostComment($id = 0, $category_id = 0)
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

        return $this->render('/admin/post-comment', ['category' => $category, 'model' => $post, 'category_id' => $category_id]);
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


    //index content
    public function actionContent()
    {
        app()->session['page'] = 2;

        return $this->render('/admin/content-index-big-pic');
    }

    public function actionContentIndexBigPic()
    {
        return $this->render('/admin/content-index-big-pic');
    }

    public function actionContentIndexTag()
    {
        return $this->render('/admin/content-index-tag');
    }

    public function actionContentIndexPost()
    {
        return $this->render('/admin/content-index-post');
    }

    public function actionContentIndexComment()
    {
        return $this->render('/admin/content-index-comment');
    }

    public function actionContentPostHotPost()
    {
        return $this->render('/admin/content-view-post');
    }

    public function actionContentPostHotComment()
    {
        return $this->render('/admin/content-view-comment');
    }

    public function actionSetConfig()
    {
        $key = $_REQUEST['key'];
        $value = $_REQUEST['value'];

        $data['code'] = 0;
        if (setConfig($key, $value))
        {
            $data['code'] = 1;
        }

        $this->finish($data);
    }

    public function actionContentSpecialColumn()
    {
        return $this->render('/admin/content-special-column');
    }


    //用户模块
    public function actionUser()
    {
        return $this->render('/admin/user-list');
    }

    public function actionUserList()
    {
        app()->session['page'] = 3;
        $query = new ActiveQuery(User::className());
        $query->orderBy(['id' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]); 

        return $this->render('/admin/user-list',['provider' => $provider]);
    }

    public function actionUserEdit($id = 0)
    {
        app()->session['page'] = 3;

        $id = intval($id);
        $user = User::find()->where(['id' => $id])->one();
        if (!$user)
        {
            $user = new User();
        }
        if ($user->load(app()->request->post()))
        {
            // dump($user->load(app()->request->post()));
            if ($user->save())
            {
                $this->redirect(url('/admin/user-list'));
            }
        }
        return $this->render('/admin/user-edit',['model' => $user]);
    }

    public function actionUserDelete()
    {
        $id = intval($_REQUEST['id']);

        $data = ['code' => 0];

        $count = User::deleteAll(['id' => $id]);
        if ($count < 1)
        {
            $data['code'] = 1;
        }

        $this->finish($data);
    }
    // public function actionContentComment()
    // {
    //     // $comment_list = PostComment::findBySql("select * from {{%post_comment}} order by post_id")->all();
    //     // dump($comment_list);die();
    //     // $post_list = Post::findBySql("select * from {{%post}} where title like \"%$keyword%\" or content like \"%$keyword%\" or tag like  \"%$keyword%\" ")->all();
    //     $query = new ActiveQuery(Post::className());
    //     $query->orderBy(['id' => SORT_DESC]);

    //     $provider = new ActiveDataProvider([
    //         'query' => $query,
    //         'pagination' => [
    //             'pageSize' => 20,
    //         ],
    //     ]);
    //     return $this->render('/admin/content-comment',['provider' => $provider]);
    // }

}
