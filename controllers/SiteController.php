<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\component\BaseController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Process;
use app\models\Post;
use app\models\PostAction;
use app\models\PostComment;
use app\models\User;

class SiteController extends BaseController
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

    public function actionIndex($page = 1)
    {
        $page = intval($page);

        $post_list = Post::find()->orderBy(['created' => SORT_DESC])->limit(10)->offset(($page - 1) * 20)->all();
        $post_id_1 = sql(' select post_id from {{%post_action}} where type = :type group by post_id order by count(post_id) desc limit 0, 1')
                    ->bindValues([':type' => PostAction::TYPE_LIKE])->queryScalar();
        $post_title_1 = sql (' select title from {{%post}} where id = :post_id')
                    ->bindValues([':post_id' => $post_id_1])->queryScalar();
        $post_id_2 = sql(' select post_id from {{%post_action}} where type = :type group by post_id order by count(post_id) desc limit 1, 1')
                    ->bindValues([':type' => PostAction::TYPE_LIKE])->queryScalar();
        $post_title_2 = sql (' select title from {{%post}} where id = :post_id')
                    ->bindValues([':post_id' => $post_id_2])->queryScalar();

        $fcomment_id_1 = sql (' select comment_id from {{%post_action}} where type = :type group by comment_id order by count(comment_id) desc limit 0, 1')
                    ->bindValues([':type' => PostAction::TYPE_COMMENT_LIKE])->queryScalar();
        // $fcomment_content_1 = sql(' select content from {{%post_comment}} where id = :comment_id')
        //             ->bindValues([':comment_id' => $fcomment_id_1])->queryScalar();
        $fcomment_postid_1 = sql (' select post_id from {{%post_action}} where comment_id = :comment_id')
                            ->bindValues([':comment_id' => $fcomment_id_1])->queryScalar();
        $fcomment_title_1 = sql(' select title from {{%post}} where id = :post_id')
                            ->bindValues([':post_id' => $fcomment_postid_1])->queryScalar();
        $fcomment_content_1 = PostComment::find()->where(['id' => $fcomment_id_1])->one();


        $fcomment_id_2 = sql (' select comment_id from {{%post_action}} where type = :type group by comment_id order by count(comment_id) desc limit 1, 1')
                    ->bindValues([':type' => PostAction::TYPE_COMMENT_LIKE])->queryScalar();
        $fcomment_postid_2 = sql (' select post_id from {{%post_action}} where comment_id = :comment_id')
                            ->bindValues([':comment_id' => $fcomment_id_2])->queryScalar();
        $fcomment_content_2 = PostComment::find()->where(['id' => $fcomment_id_2])->one();
        $fcomment_title_2 = sql(' select title from {{%post}} where id = :post_id')
                            ->bindValues([':post_id' => $fcomment_postid_2])->queryScalar();
        // $fcomment_2 = PostAction::find()->where(['type' => PostAction::TYPE_COMMENT_LIKE]->groupBy(['comment_id'])->orderBy([]))

        $fcomment_id_3 = sql (' select comment_id from {{%post_action}} where type = :type group by comment_id order by count(comment_id) desc limit 2, 1')
                    ->bindValues([':type' => PostAction::TYPE_COMMENT_LIKE])->queryScalar();
        $fcomment_postid_3 = sql (' select post_id from {{%post_action}} where comment_id = :comment_id')
                            ->bindValues([':comment_id' => $fcomment_id_3])->queryScalar();
        $fcomment_content_3 = PostComment::find()->where(['id' => $fcomment_id_3])->one();
        $fcomment_title_3 = sql(' select title from {{%post}} where id = :post_id')
                            ->bindValues([':post_id' => $fcomment_postid_3])->queryScalar();

        //待优化


        return $this->render('/site/index', ['post_list' => $post_list, 'page' => $page, 'post_title_1' => $post_title_1, 'post_title_2' => $post_title_2, 'fcomment_content_1' => $fcomment_content_1, 'fcomment_content_2' => $fcomment_content_2, 'fcomment_content_3' => $fcomment_content_3,'fcomment_title_1' => $fcomment_title_1, 'fcomment_title_2' => $fcomment_title_2, 'fcomment_title_3'=>$fcomment_title_3]);
    }
    

    public function actionPostList()
    {
        $last_post_id = intval($_REQUEST['last_post_id']);
        $post_list = Post::find()->where(" id < $last_post_id ")->orderBy(['created' => SORT_DESC])->limit(5)->all();
        $html = '';
        foreach ($post_list as $post)
        {
            $html .= $this->renderPartial('/site/post-item', ['post' => $post]) . "\n";
        }

        return $html;
    }

    public function actionArticle()
    {
        return $this->render('/site/article');
    }

    public function actionInfo()
    {
        return $this->render('/site/info');
    }
    public function actionGetInfo()
    {
        $data['userinfo'] = user()->attributes;
        $this->finish($data);
    }

    public function actionPost(){
        return $this->render('/site/post');
    }

    public function actionCollection(){
        return $this->render('/site/collection');
    }

    public function actionPass()
    {
        dump(md5(md5('inno')));
    }

    // public function actionCalColumn()
    // {
    //     dump(sprintf("%.8f", 80.0 / 1200));
    //     dump(sprintf("%.8f", 160.0 / 1200));
    //     dump(sprintf("%.8f", 240.0 / 1200));
    //     dump(sprintf("%.8f", 320.0 / 1200));
    //     dump(sprintf("%.8f", 400.0 / 1200));
    //     dump(sprintf("%.8f", 480.0 / 1200));
    //     dump(sprintf("%.8f", 560.0 / 1200));
    //     dump(sprintf("%.8f", 640.0 / 1200));
    //     dump(sprintf("%.8f", 720.0 / 1200));
    //     dump(sprintf("%.8f", 800.0 / 1200));
    //     dump(sprintf("%.8f", 880.0 / 1200));
    //     dump(sprintf("%.8f", 960.0 / 1200));
    //     dump(sprintf("%.8f", 1040.0 / 1200));
    //     dump(sprintf("%.8f", 1120.0 / 1200));
    //     dump(sprintf("%.8f", 1200.0 / 1200));
    //     die();
    // }

}
