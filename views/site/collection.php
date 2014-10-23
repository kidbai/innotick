<div  id="info" class="wrapper">
	<div class="column">
		<div class="info col-15">
			<div class="img info-circle bg-pink fl ml-80 mt-45">
				<div class="avatar-circle"></div>
			</div>
			<div class="text fl ml-30 mt-65">
				<div class="fs-32 lp-4 wt"><?= user()->name?></div>
				<div class="fs-14 weibolink-color lp-1"><?= user()->url?></div>
			</div>
			<div class="menu ml-80">
				<ul>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="/site/info"><p class="fs-17 orange">基本信息</p></a></div>
					</li>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="#"><p class="fs-17 orange">账号绑定</p></a></div>
					</li>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="#"><p class="fs-17 orange">通知设定</p></a></div>
					</li>
					<li>
						<div class="color-line  bg-orange"></div>
						<div class="list bg-wt active"><a href="/site/collection"><p class="fs-17 orange">我的收藏</p></a></div>
					</li>
				</ul>
			</div>
		</div>
		
	</div>

	<div class="column bg-setting">
		<div class="fill"></div>
		<div class="setting ml-80 bg-wt">
			<div class="collection ml-20 mr-20 mt-20 bg-orange">
				<ul>
					<li class="fl ml-38">分类</li>
					<li class="fl ml-50">标题</li>
					<li class="fr mr-60">回复数</li>
					<li class="fr mr-60">时间</li>
				</ul>	
			</div>	

			<?php

			echo $this->render('/user/collection-item', ['post_fav_list' => $post_fav_list]);
			?>
			<div class="collection-cont mr-20 ml-20">
				<div class="collection-green site fl ml-38 category">网站</div>
				<div class="title fl ml-46">韩国电子优惠券服务Spoqa融资200万美</div>
				<div class="fr comment-num mr-60">22123</div>
				<div class="fr time mr-50">五月前</div>
			</div>
			

			<div class="pagination">
				<div class="next pagination-btn orange fr">下一页</div>
				<div class="previous pagination-btn orange fr">上一页</div>
			</div>
		</div>	
	</div>
	
	
</div>
<script src="/js/jquery-1.11.1.min.js"></script>
<script>
	$("#info .column .info .menu li").mouseover(function(){
		$("#info .column .info .menu li .list").removeClass("active-2");
		$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
		$(this).children(".color-line").addClass("bg-orange-2");
		$(this).children(".list").addClass("active-2");
	}).mouseout(function(){
		$("#info .column .info .menu li .list").removeClass("active-2");
		$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
	});

	$("#info .pagination .previous").mouseover(function(){
		// $(this).css({"backgroundColor":"#ee6350",});
		$(this).addClass("bg-orange wt").removeClass("orange");
	}).mouseout(function(){
		$(this).addClass("orange").removeClass("bg-orange wt");
	});
	$("#info .pagination .next").mouseover(function(){
		// $(this).css({"backgroundColor":"#ee6350",});
		$(this).addClass("bg-orange wt").removeClass("orange");
	}).mouseout(function(){
		$(this).addClass("orange").removeClass("bg-orange wt");
	});
</script>