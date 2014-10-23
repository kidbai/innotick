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
use app\models\User;

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
        // $this->checkParams([""])
        $id = intval($id);
        $post = Post::find()->where(['id' => $id])->one();
        $comment_list = PostComment::find()->where(['post_id' => $id])->orderBy(['id' => SORT_ASC])->all();

        // $hot_post_list = PostAction::find()->where(['type' => PostAction::TYPE_LIKE])->groupBy('post_id')->orderBy('count(post_id) desc')->limit(2)->all();

        $post_tag = Post::findBySql("select * from {{%post}} where id = :id", [':id' => $id])->one();
        $tag = [];
        $tag = explode(',', $post_tag->tag);
        if(count($tag) == 1)
        {
            $correlate_post = Post::findBySql(" select * from {{%post}} where tag like \"%$tag[0]%\" and id <> :id order by id limit 2",[':id' => $id])->all();
        }
        else
        {
            $correlate_post = Post::findBySql(" select * from {{%post}} where (tag like \"%$tag[0]%\" or tag like \"%$tag[1]%\") and id <> :id order by id limit 2 ",[':id' => $id])->all();
        }
        $hot_post_list = PostAction::findBySql(' select * from {{%post_action}} where type = :type group by post_id order by count(post_id) desc limit 0, 2', [':type' => PostAction::TYPE_LIKE])->all();
        $hot_post_comment_list = PostAction::findBySql(" select * from {{%post_action}} where type = :type and post_id = :post_id group by comment_id order by count(comment_id) desc limit 10", [':type' => PostAction::TYPE_COMMENT_LIKE, ':post_id' => $id])->all();
        // dump($hot_post_comment_list);die();

        $post_favourite = sql(' select count(*) from {{%post_favourite}} where post_id = :post_id ')
                            ->bindValues([':post_id' => $id])->queryScalar();
        

        return $this->render('/post/view', ['post' => $post, 'comment_list' => $comment_list, 'correlate_post' => $correlate_post, 'post_favourite' =>$post_favourite, 'hot_post_comment_list' => $hot_post_comment_list ]);
    }

    public function actionFavouriteAdd() //文章收藏
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
        $post_comment->user_id = intval(user()->id);
        $post_comment->content = $content;
        if (!$post_comment->save())
        {
            $this->finishError(-1, 'save comment error');
        }
        $commentlikecount = $post_comment->getLikeCount();
        $commentdislikecount = $post_comment->getDisLikeCount();
        $data['post_id'] = $post_id;
        $data['content'] = $content;
        $data['likecount'] = $commentlikecount;
        $data['dislikecount'] = $commentdislikecount;

        // $html = '';
        // $html = $this->renderPartial('/site/comment-template', ['post_comment' => $post_comment]);
        // $data['html'] = $html;
        $this->finish($data);
    }

    public function actionActionSave()
    {
        $this->checkParams(['post_id', 'type']);
        $data['code'] = 0;
        $type = intval($_REQUEST['type']);
        $post_id = intval($_REQUEST['post_id']);
        // $comment_id = intval($_REQUEST['comment_id']);
       
       
        if (!in_array($type, [PostAction::TYPE_LIKE, PostAction::TYPE_DISLIKE, PostAction::TYPE_COMMENT_LIKE, PostAction::TYPE_COMMENT_DISLIKE]))
        {
            $this->finishError(-1, 'wrong type');
        }

        $post = Post::find()->where(['id' => $post_id])->one(); // 获取文章

        if (!$post)
        {
            $this->finishError(-2, 'post not exists');
        }

        
        $post_comment = null;

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
            $post_comment = PostComment::find()->where(['id' => $comment_id])->one();
            if (!$post_comment)
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
                break;
            case PostAction::TYPE_COMMENT_LIKE:
                $count = $post_comment->getLikeCount();
                break;
            case PostAction::TYPE_COMMENT_DISLIKE:
                $count = $post_comment->getDisLikeCount();
                break;
            default:
                # code...
                break;
        }
        $data['count'] = $count;

        $this->finish($data);
    }

    public function actionComment()
    {
        $this->checkParams(['post_id']);
        $post_id = intval($_REQUEST['post_id']);
        $comment_list = PostComment::find()->where(['post_id' => $post_id])->orderBy(['id' => SORT_ASC])->all();
        return $this->renderPartial('/post/comment', ['comment_list' => $comment_list]);
    }

    public function actionCommentNum()
    {
        $this->checkParams(['post_id']);
        $post_id = intval($_REQUEST['post_id']);
        $comment_num = sql(' select count(*) from {{%post_comment}} where post_id = :post_id ')
                        ->bindValues([':post_id' => $post_id])->queryScalar();
        $data['comment_num'] = $comment_num;
        $this->finish($data);
    }



    public function actionCollectionPost()
    {
        $post_id = ($_REQUEST['post_id']);
        $user_id = user()->id;
        $post_fav = new PostFavourite();
        $post_fav->post_id = $post_id;
        $post_fav->user_id = $user_id;

        $post_fav_exist = PostFavourite::find()->where(['post_id' => $post_id,'user_id' => $user_id])->one();
        // dump($post_fav_num);die();
        if($post_fav_exist)
        {
            $this->finishError(4, 'exist');
        }  
        if(!$post_fav->save())
        {
            $this->finishError(-5, 'sava action error');
        }
        $post_fav_num = sql(' select count(*) from {{%post_favourite}} where post_id = :post_id ')
                            ->bindValues([':post_id' => $post_id])->queryScalar(); 
        

        // $data['post_fav_num'] = $post_fav_num;
        $this->finish($post_fav_num);
    } 




}
