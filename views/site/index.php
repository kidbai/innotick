<div id="content" class="wrapper">	
	<div class="column content-up">
		<div class="title-img">
			<img src="/img/background.jpg" width="1200" height="600" alt=""/>	
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
				<div class="fs-14 fl loadnext">正在为您加载第X页面</div>	
				<a class="fs-14 fr" href="javascript:;" onclick="nextPage(<?= $page?>)">下一页</a>
			</div>
	    </div>

	   <!--中右内容--> 
	    <div class="col-4 right">
	    	<div class="hot-list bg-click">
	    		<div class="hot">
	    			<div class="img-line-up"></div>	
	    			<a href="/post/121"><img src="/upload/img/5ca0a6d7ae7ca12449a7ed9e06c0209e.jpg" alt=""/></a>	
	    			<div class="fs-13 hot-text">更爱道歉的苹果，正在犯更多的错</div>
	    		</div>
	    		<div class="hot">
	    			<div class="img-line-down"></div>	
	    			<div>
	    				<a href="/post/119"><img src="/upload/img/0f62a6992b1add433f74805078c50297.jpg" alt=""/></a>	
	    			</div>
	    			<div class="fs-13 hot-text">打开创意之门其实不难</div>
	    			
	    		</div>
				<!-- 屏幕header-->
	    		<div class="header">
	    			<p class="fs-13">优质评论</p>
	    		</div>
	    		<HR align=center width=86.66666667% color=#ee6350 SIZE=2 style="margin-left:20px;" noShade>

	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl">用户名</div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12">一小时前 </div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text">看了那么多有关于创业的例子，成功的，失败的都有，只想说：成功的路上没有太多可鉴和复制的。别人走过的路，你可以走，但走的方式和方法要更出色。没人走过的路，你也可以走，但走的很坎坷很纠结。</div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于&nbsp;&nbsp;<a class="fs-14 lp-1 lightgray" href="#">周鸿祎的互联网方法论</a></div>
	    			</div>
	    		</div>
	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl">用户名</div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12">一小时前 </div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text">看了那么多有关于创业的例子，成功的，失败的都有，只想说：成功的路上没有太多可鉴和复制的。别人走过的路，你可以走，但走的方式和方法要更出色。没人走过的路，你也可以走，但走的很坎坷很纠结。</div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于&nbsp;&nbsp;<a class="fs-14 lp-1 lightgray" href="#">周鸿祎的互联网方法论</a></div>
	    			</div>
	    		</div>
	    		<div class="article border-bottom-1">
	    			<div class="customer">
	    				<div class="fs-14 orange fl">用户名</div>
	    				<div class="ml-12 fl dot">·</div>
	    				<div class="fs-14 fl time ml-12">一小时前 </div>

	    			</div>	
	    			<div class="cont">
	    				<div class="fs-14 text">看了那么多有关于创业的例子，成功的，失败的都有，只想说：成功的路上没有太多可鉴和复制的。别人走过的路，你可以走，但走的方式和方法要更出色。没人走过的路，你也可以走，但走的很坎坷很纠结。</div>
	    			</div>
	    			<div class="from fs-15 lp-1">
	    				<div class="fs-14 lp-1 from-text">评论于&nbsp;&nbsp;<a class="fs-14 lp-1 lightgray" href="#">周鸿祎的互联网方法论</a></div>
	    			</div>
	    		</div>
				
				<!-- 二维码-->
				<!-- <div class="qrcode">
					<div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
					<img src="#" alt="" width="155" height="155" />
				</div> -->

	    	</div>
	    </div>
	    <div class="qrcode hide">
			<div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
			<img src="#" alt="" width="155" height="155" />
		</div>
	</div>
		
</div>

<script src="/js/jquery-1.11.1.min.js"></script>
<!-- // var page = <?= $page ?>; -->
<script src="/js/index-content.js"></script>

