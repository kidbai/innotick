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

class PostController extends BaseController
{
    public $layout = 'main';

    public function beforeAction($action)
    {
        if (in_array($this->action->id, ['action', 'comment-add']) && app()->user->isGuest)
        {
            $this->redirect('/user/login');
            return false;
        }

        return parent::beforeAction($action);
    }

    public function actionView($id)
    {
        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();

        return $this->render('/post/view', ['post' => $post]);
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

        $this->finish($data);
    }

    public function actionAction()
    {
        $this->checkParams(['post_id', 'type']);
        $data['code'] = 0;
        $type = intval($_REQUEST['type']);
        $post_id = intval($_REQUEST['post_id']);

        if (!in_array($type, [PostAction::TYPE_LIKE, PostAction::TYPE_DISLIKE, PostAction::TYPE_COMMENT_LIKE, PostAction::TYPE_COMMENT_DISLIKE]))
        {
            $this->finishError(-1, 'wrong type');
        }

        $post = sql(' select id from {{%post}} where id = :id ')->bindValues(['id' => $post_id])->queryScalar();
        if (!$post)
        {
            $this->finishError(-2, 'post not exists');
        }

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

            $action = sql(' select id from {{%post_action}} where comment_id = :comment_id and type = :type ')
                        ->bindValues([':comment_id' => $comment_id, ':type' => $type])->queryScalar();
            if ($action)
            {
                $this->finishError(-4, 'action exists');
            } 

            $post_action->comment_id = $comment_id;           
        }
        else if ($type == PostAction::TYPE_LIKE || $type == PostAction::TYPE_DISLIKE)
        {
            $action = sql(' select id from {{%post_action}} where post_id = :post_id and type = :type ')
                        ->bindValues([':post_id' => $post_id, ':type' => $type])->queryScalar();
            if ($action)
            {
                $this->finishError(-4, 'action exists');
            }
        }

        if (!$post_action->save())
        {
            $this->finishError(-5, 'save action error');
        }

        $this->finish($data);
    }

}
