<?php
use app\component\DXConst;
$index_pic_data = getConfig(DXConst::KEY_CONFIG_INDEX_PIC);
if ($index_pic_data != null)
{
	$index_pic = json_decode($index_pic_data, true);
}
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
				<li class="wt ml-400 mr-15">小米</li>
				<li class="wt mr-15">Tesla</li>
				<li class="wt mr-15">Oculus</li>
				<li class="wt mr-15">Uber</li>
				<li class="wt mr-15">比特币</li>
				<li class="wt mr-10">更多</li>
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
				<?
				$i=0;
				foreach ($action_hot_post_list as $action)
				{
					$post = $action->post;
					if (!$post) continue;
					$i++;
				?>
		    		<div class="hot <? if($i>0) echo 'mt0';?>">
		    			<div class="img-line-down"></div>	
						<a href="<?= $post->url ?>"><img src="/upload/img/<?= $post->img ?>" alt=""/></a>	
		    			<div class="fs-13 hot-text"><?= $post->title ?></div>	
		    		</div>
				<?
				}
				?>

				<!-- 屏幕header-->
	    		<div class="header">
	    			<p class="fs-13">优质评论</p>
	    		</div>
	    		<HR align=center width=86.66666667% color=#ee6350 SIZE=2 style="margin-left:20px;" noShade>

				<?
				foreach ($action_hot_comment_list as $action)
				{
					$comment = $action->comment;
					if (!$comment) continue;
					$post = $comment->post;
					if (!$post) continue;
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
		    				<div class="fs-14 lp-1 from-text">评论于<a class="fs-14 lp-1 lightgray comment_title" href="<?= $post->url?>"><?= $post->title ?></a></div>
		    			</div>
		    		</div>
				<?
				}
				?>
				
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

