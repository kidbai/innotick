<?php
use app\component\DXConst;
use app\models\Post;
use app\models\PostComment;
use yii\widgets\ActiveForm;
$index_pic_data = getConfig(DXConst::KEY_CONFIG_INDEX_PIC);

$index_tag_data = getConfig(DXConst::KEY_CONFIG_INDEX_TAG);
$index_post_data = getConfig(DXConst::KEY_CONFIG_INDEX_POST);
$index_comment_data = getConfig(DXConst::KEY_CONFIG_INDEX_COMMENT);
if ($index_pic_data != null)
{
	$index_pic = json_decode($index_pic_data, true);
	// dump($index_pic);die();	
}
else
{
    $index_pic[0]['img'] = "background.jpg";    
}

if($index_tag_data != null)
{
    $index_tag = json_decode($index_tag_data, true);
    // dump($index_tag) ;dump($index_tag['tag']['tag1']);die();

}
else
{
    $index_tag['tag']['tag1'] = '小米';
    $index_tag['tag']['tag2'] = 'Tesla';
    $index_tag['tag']['tag3'] = 'Oculus';
    $index_tag['tag']['tag4'] = 'Uber';
    $index_tag['tag']['tag5'] = '比特币';
    $index_tag['tag']['tag6'] = '更多';
  
}

if($index_post_data != null)
{
	$index_post = json_decode($index_post_data,true);
	$post1_id = intval($index_post['post']['post1']);
	// dump($post1_id);
	$post2_id = intval($index_post['post']['post2']);
	$post1 = Post::find()->where(['id' => $post1_id])->one();
	// dump($post1);die();
}
else
{
	$post1_id = 100;
	$post2_id = 99;
}

$post1 = Post::find()->where(['id' => $post1_id])->one();
$post2 = Post::find()->where(['id' => $post2_id])->one();

if($index_comment_data != null)
{
    $index_comment = json_decode($index_comment_data, true);
    $comment1_id = $index_comment['comment']['comment1'];
    $comment2_id = $index_comment['comment']['comment2'];
    $comment3_id = $index_comment['comment']['comment3'];
}
else
{
    $comment1_id = 10;  //default
    $comment2_id = 11;  //default
    $comment3_id = 12;  //default
}

$comment1 = PostComment::find()->where(['id' => $comment1_id])->one();
$comment2 = PostComment::find()->where(['id' => $comment2_id])->one();
$comment3 = PostComment::find()->where(['id' => $comment3_id])->one();
// $comment_test = PostComment::findBySql(' select id from {{%post_comment}} where id = :comment1_id or id = :comment2_id or id = comment3_id', [':comment1_id' => $comment1_id, ':comment2_id' => $comment2_id, 'comment3_id' => $comment3_id])->all();
// dump($comment_test);die();
?>
<div id="content" class="wrapper">	
	<div class="column content-up">
		<div class="title-img">
			<img src="/upload/img/<?= $index_pic[0]['img']?>" width="1200" height="600" alt=""/>	
		</div>	
		<div class="nav">
			
			<ul>
				<li class="ml-60 wt active"><div class="line"></div>最新</li>
				<li class="wt ml-10">智能</li>
				<li class="wt ml-400 mr-15"><?= $index_tag['tag']['tag1']?></li>
				<li class="wt mr-15"><?= $index_tag['tag']['tag2']?></li>
				<li class="wt mr-15"><?= $index_tag['tag']['tag3']?></li>
				<li class="wt mr-15"><?= $index_tag['tag']['tag4']?></li>
				<li class="wt mr-15"><?= $index_tag['tag']['tag5']?></li>
				<li class="wt mr-10"><?= $index_tag['tag']['tag6']?></li>
			</ul>
		</div>
	</div>
	<div class="column content-down">
	    <div class="col-11 left">
			<div id="post-holder" class="load-content">
			<?
			foreach ($post_list as $post)
			{
				echo $this->render('/site/post-item', ['post' => $post]);
			}
			?>
			</div>
	    	<div class="load loadgray">
	    		<div class="spinner fl">
			        <div class="bounce1 load-animation"></div>
			        <div class="bounce2 load-animation"></div>
			        <div class="bounce3 load-animation"></div>
			    </div>
				<div class="fs-14 fl loadnext">正在为您加载第<?= $page + 1?>页面</div>	
				<a class="fs-14 fr" href="javascript:;" onclick="nextPage(<?= $page?>)">下一页</a>
			</div>
	    </div>

	   <!--中右内容--> 
	    <div class="col-4 right">
	    	<div class="hot-list bg-click">
				
		    	<div class="hot ">
				    <div class="img-line-down"></div>   
				    <a href="<?= $post1->url?>"><img src="/upload/img/<?= $post1->img?>" alt=""/></a>   
				    <div class="fs-13 hot-text"><?= $post1->title?></div>   
				</div>
				<div class="hot mt0">
				    <div class="img-line-down"></div>   
				    <a href="<?= $post2->url?>"><img src="/upload/img/<?= $post2->img?>" alt=""/></a>   
				    <div class="fs-13 hot-text"><?= $post2->title?></div>   
				</div>
				
				<!-- 屏幕header-->
	    		<div class="header">
	    			<p class="fs-13">优质评论</p>
	    		</div>
	    		<HR align=center width=86.66666667% color=#ee6350 SIZE=2 style="margin-left:20px;" noShade>

					<!-- comment1 -->
	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl"><?= $comment1->user->username?></div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12"><?= timeFormat($comment1->created, 'ago') ?></div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text"><?= $comment1->content?></div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于<a class="fs-14 lp-1 lightgray comment_title" href="<?= $comment1->post->url?>"><?= $comment1->post->title ?></a></div>
	    			</div>
	    		</div>
					<!-- comment2 -->
	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl"><?= $comment2->user->username?></div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12"><?= timeFormat($comment2->created, 'ago') ?></div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text"><?= $comment2->content?></div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于<a class="fs-14 lp-1 lightgray comment_title" href="<?= $comment2->post->url?>"><?= $comment2->post->title ?></a></div>
	    			</div>
	    		</div>
					<!-- comment3 -->
	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl"><?= $comment3->user->username?></div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12"><?= timeFormat($comment3->created, 'ago') ?></div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text"><?= $comment3->content?></div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于<a class="fs-14 lp-1 lightgray comment_title" href="<?= $comment1->post->url?>"><?= $comment3->post->title ?></a></div>
	    			</div>
	    		</div>
				
				
				<!-- 二维码-->
				<!-- <div class="qrcode">
					<div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
					<img src="#" alt="" width="155" height="155" />
				</div> -->

	    	</div>
	    </div>
	    <div class="clear-10"></div>
	    <div class="qrcode">
	    	<div class="clear-10"></div>
			<div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
			<img src="/img/qr.png" alt="" width="155" height="155" />
		</div>
	</div>
		
</div>

<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<!-- // var page = <?= $page ?>; -->
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/index-content.js"></script>

