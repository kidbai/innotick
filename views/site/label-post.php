<?php
use app\component\DXConst;
use app\models\Post;
use app\models\PostComment;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use app\component\PrevNextPager;

$pic = getConfig(DXConst::KEY_CONFIG_INDEX_PIC);
$tags = getConfig(DXConst::KEY_CONFIG_INDEX_TAG);
$hot_post_ids = getConfig(DXConst::KEY_CONFIG_INDEX_POST);
$hot_comment_ids = getConfig(DXConst::KEY_CONFIG_INDEX_COMMENT);
$special_column = getConfig(DXConst::KEY_CONFIG_SPECIAL_COLUMN);
$special_column = json_decode($special_column, true);
// dump($special_column);die();

$tag_list = explode('-', trim(trim($tags, '-')));

$hot_comment_list = null;
$hot_comment_id_list = [];
$hot_comment_ids = explode('-', trim(trim($hot_comment_ids), '-'));
if (is_array($hot_comment_ids))
{
    foreach ($hot_comment_ids as $comment_id)
    {
        if (!in_array(intval($comment_id), $hot_comment_id_list))
        {
            $hot_comment_id_list[] = intval($comment_id);
        }
    }
}
if (count($hot_comment_id_list) > 0)
{
    $hot_comment_ids = implode(',', $hot_comment_id_list);
    $hot_comment_list = PostComment::findBySql("select * from {{%post_comment}} where id in ($hot_comment_ids)")->all();
}




$hot_post_list = null;
$hot_post_id_list = [];
$hot_post_ids = explode('-', trim(trim($hot_post_ids), '-'));
if (is_array($hot_post_ids))
{
    foreach ($hot_post_ids as $post_id)
    {
        if (!in_array(intval($post_id), $hot_post_id_list))
        {
            $hot_post_id_list[] = intval($post_id);
        }
    }
}
if (count($hot_post_id_list) > 0)
{
    $hot_post_ids = implode(',', $hot_post_id_list);
    $hot_post_list = Post::findBySql("select * from {{%post}} where id in ($hot_post_ids)")->all();
}



// dump($hot_post);die();




?>
<div id="content" class="wrapper">  
    <div class="column content-up">
        <div class="title-img">
            <img src="/upload/img/<?= $pic ?>" width="1200" height="600" alt=""/>
        </div>  
        <div class="nav">
            
            <ul>
                <li class="ml-60 wt active"><div class="line"></div>最新</li>
                <li class="wt ml-10">智能</li>
            </ul>

            <ul class="fr">
                <?
                if (is_array($tag_list))
                {
                    foreach ($tag_list as $tag)
                    {?>
                        <li class="wt mr-15"><?= $tag?></li>
                    <?
                    }

                }
                ?>
            </ul>
        </div>
    </div>
    <div class="column content-down">
        <div class="col-11 left">
            <div id="post-holder" class="load-content">
            <?php
            echo ListView::widget([
                'dataProvider' => $provider,
                'itemView' => '/site/post-template',
                'layout' => '{items}<div class="clear"></div>{pager}',
                'separator' => '',
                'emptyText' => '',
                'pager' => [
                    'class' => '\app\component\postPrevNextPager'
                 ]
            ]);
            ?>           
            </div>
            <!-- <div class="load loadgray">
                <div class="spinner fl">
                    <div class="bounce1 load-animation"></div>
                    <div class="bounce2 load-animation"></div>
                    <div class="bounce3 load-animation"></div>
                </div>
                <div class="fs-14 fl loadnext">正在为您加载第页面</div>   
                <a class="fs-14 fr" href="javascript:;" onclick="">下一页</a>
            </div> -->
        </div>

       <!--中右内容--> 
        <div class="col-4 right">
            <div class="hot-list bg-click">
                <div class="clear-20"></div>
                <?
                if (is_array($hot_post_list) && count($hot_post_list) > 0)
                {
                    $i = 0;
                    foreach ($hot_post_list as $hot_post)
                    {
                        $i++;
                        ?>
                        <div class="hot <? if($i > 0){ echo 'mt0';}?>">
                            <div class="img-line-down"></div>
                            <a href="<?= $hot_post->url?>"><img src="/upload/img/<?= $hot_post->img?>" alt=""/></a>
                            <a href="<?= $hot_post->url?>" class="fs-13 hot-text"><?= $hot_post->title?></a>
                        </div>
                    <?
                    }

                }


                if (is_array($hot_comment_list) && count($hot_comment_list) > 0)
                {

                ?>
                    <div class="header">
                        <p class="fs-13">优质评论</p>
                    </div>
                    <HR align=center width=86.66666667% color=#ee6350 SIZE=2 style="margin-left:20px;" noShade>


                    <?
                    foreach ($hot_comment_list as $comment)
                    {
                        ?>

                        <div class="article border-bottom-1">
                            <div class="customer">
                                <div class="fs-14 orange fl"><?= $comment->user->username?></div>
                                <div class="ml-12 fl dot">·</div>
                                <div class="fs-14 fl time ml-12"><?= timeFormat($comment->created, 'ago') ?></div>

                            </div>
                            <div class="cont">
                                <div class="fs-14 text"><?= $comment->content?></div>
                            </div>
                            <div class="from fs-15 lp-1">
                                <div class="fs-14 lp-1 from-text">评论于<a class="fs-14 lp-1 lightgray comment_title" href="<?= $comment->post->url?>"><?= $comment->post->title ?></a></div>
                            </div>
                        </div>

                    <?
                    }
                }
                ?>

                <div class="clear-20"></div>

                <div class="qrcode">
                    <div class="clear-10"></div>
                    <div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
                    <img src="/img/qr.png" alt="" width="155" height="155" />
                </div>  
                        
                
                <!-- 二维码-->
                <!-- <div class="qrcode">
                    <div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
                    <img src="#" alt="" width="155" height="155" />
                </div> -->

            </div>
        </div>
      
    </div>
        
</div>

<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/index-content.js"></script>
