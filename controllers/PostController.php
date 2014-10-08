<?php

namespace app\controllers;

use Yii;
use app\component\BaseController;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Post;
use app\models\PostAction;
use app\models\PostComment;
use app\models\PostFavourite;

class PostController extends BaseController
{
    public $layout = 'main';

    public function beforeAction($action)
    {
        if (in_array($this->action->id, ['action-save', 'comment-add']) && app()->user->isGuest)
        {
            $this->redirect('/user/login');
            return false;
        }

        return parent::beforeAction($action);
    }

    public function actionList()
    {

    }

    public function actionTag()
    {
        $post_list = Post::find()->orderBy(['created' => SORT_DESC])->limit(10)->offset(($page - 1) * 20)->all();

        $this->render('/post/');

    }

    public function actionView($id)
    {
        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();

        return $this->render('/post/view', ['post' => $post]);
    }

    public function actionFavouriteAdd()
    {
        $this->checkParams(['post_id']);
        $data['code'] = 0;
        $post_id = intval($_REQUEST['post_id']);
        $user_id = intval(user()->id);

        $fav = sql(' select * from {{%post_favourite}} where post_id = :post_id and user_id = :user_id ')
                ->bindValues([':post_id' => $post_id, ':user_id' => $user_id])->query();
        if (!$fav)
        {
            $this->finishError(-1, 'favourite post exists');
        }

        $favourite = new PostFavourite();
        $favourite->post_id = $post_id;
        $favourite->user_id = user()->id;
        if (!$favourite->save())
        {
            $this->finishError(-2, 'save favourite post error');
        }

        $this->finish($data);
    }

    public function actionCommentAdd()
    {
        $this->checkParams(['post_id', 'content']);
        $data['code'] = 0;
        $post_id = intval($_REQUEST['post_id']);
        $content = $_REQUEST['content'];

        $post_comment = new PostComment();
        $post_comment->post_id = $post_id;
        $post_comment->content = $content;
        if (!$post_comment->save())
        {
            $this->finishError(-1, 'save comment error');
        }
        $data['post_id'] = $post_id;
        $data['content'] = $content;
        $this->finish($data);
    }

    public function actionActionSave()
    {
        $this->checkParams(['post_id', 'type']);
        $data['code'] = 0;
        $type = intval($_REQUEST['type']);
        $post_id = intval($_REQUEST['post_id']);

        if (!in_array($type, [PostAction::TYPE_LIKE, PostAction::TYPE_DISLIKE, PostAction::TYPE_COMMENT_LIKE, PostAction::TYPE_COMMENT_DISLIKE]))
        {
            $this->finishError(-1, 'wrong type');
        }

        $post = Post::find()->where(['id' => $post_id])->one(); // 获取文章
        if (!$post)
        {
            $this->finishError(-2, 'post not exists');
        }

        $user_id = intval(user()->id);

        $post_action = new PostAction();
        $post_action->post_id = $post_id;
        $post_action->comment_id = 0;
        $post_action->type = $type;
        $post_action->user_id = user()->id;

        if ($type == PostAction::TYPE_COMMENT_LIKE || $type == PostAction::TYPE_COMMENT_DISLIKE)
        {
            $this->checkParams(['comment_id']);
            $comment_id = intval($_REQUEST['comment_id']);
            $comment = sql(' select id from {{%post_comment}} where id = :id ')->bindValues(['id' => $comment_id])->queryScalar();
            if (!$comment)
            {
                $this->finishError(-3, 'comment not exists');
            }

            $action = sql(' select id from {{%post_action}} where user_id = :user_id and comment_id = :comment_id and type = :type ')
                        ->bindValues([':user_id' => $user_id, ':comment_id' => $comment_id, ':type' => $type])->queryScalar();
            if ($action)
            {
                $this->finishError(-4, 'action exists');
            } 

            $post_action->comment_id = $comment_id;           
        }
        else if ($type == PostAction::TYPE_LIKE || $type == PostAction::TYPE_DISLIKE)
        {
            $action = sql(' select id from {{%post_action}} where user_id = :user_id and post_id = :post_id and type = :type ')
                        ->bindValues([':user_id' => $user_id, ':post_id' => $post_id, ':type' => $type])->queryScalar();
            if ($action)
            {
                $this->finishError(-4, 'action exists');
            }
        }

        if (!$post_action->save())
        {
            $this->finishError(-5, 'save action error');
        }

        $count = 0;
        switch ($type) {
            case PostAction::TYPE_LIKE:
                $count = $post->getLikeCount();
                break;
            case PostAction::TYPE_DISLIKE:
                $count = $post->getDisLikeCount();

            default:
                # code...
                break;
        }
        $data['count'] = $count;

        $this->finish($data);
    }

}
