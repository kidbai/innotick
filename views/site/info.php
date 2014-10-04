<div  id="info" class="wrapper">
	<div class="column">
		<div class="info col-15">
			<div class="img info-circle bg-pink fl ml-80 mt-45">
				<div class="avatar-circle"></div>
			</div>
			<div class="text fl ml-30 mt-65">
				<div class="fs-32 lp-4 wt">用户名</div>
				<div class="fs-14 weibolink-color lp-1">weibo.com/1944780395</div>
			</div>
			<div class="menu ml-80">
				<ul>
					<li>
						<div class="color-line bg-orange"></div>
						<div class="list bg-wt active"><a href="/site/info"><div class="fs-17 orange">基本信息</div></a></div>
					</li>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="#"><div class="fs-17 orange">账号绑定</div></a></div>
					</li>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="#"><div class="fs-17 orange">通知设定</div></a></div>
					</li>
					<li>
						<div class="color-line"></div>
						<div class="list bg-wt"><a href="/site/collection"><div class="fs-17 orange">我的收藏</div></a></div>
					</li>
				</ul>
			</div>
		</div>
		
	</div>

	<div class="column bg-setting">
		<div class="fill"></div>
		<div class="setting ml-80 bg-wt">
			<div class="email layout mt-60">
				<label><span>电子邮箱</span></label>
				<input type="text" placeholder="请输入电子邮箱"/>
			</div>
			<div class="avatar layout">
				<label><span>头像</span></label>
				<div class="img">
					<div class="circle bg-orange fl"></div>
					<a href="#"><p class="orange fs-14">更改头像</p></a>
				</div>
				
			</div>	
			<div class="clear"></div>
			<div class="user-name layout">
				<label><span>用户名</span></label>
				<input type="text"/>
			</div>
			<div class="tel layout">
				<label><span>手机号码</span></label>
				<input type="text" placeholder="绑定手机" maxlength="11"/>
				<div class="getcode"><p class="wt fs-14">获取免费短信验证码</p></div>
			</div>	
			<div class="mscode layout">
				<label><span>短信验证码</span></label>
				<input type="text" placeholder="5位数字" maxlength="5"/>
			</div>	
			<div class="sex layout">
				<label><span>性别</span></label>
				<input type="radio" name="sex" value="男"/><p class="fl fs-15 ml-5 mr-10">男</p>
				<input type="radio" name="sex" value="女"/><p class="fl fs-15 ml-5 mr-10">女</p>
				<input type="radio" name="sex" value="保密"/><p class="fl fs-15 ml-5 mr-10">保密</p>
			</div>	
			<div class="area layout">
				<label><span>所在地区</span></label>
				<!-- <div class="menu-sel fl"></div>
				<div class="menu-sel fl ml-20"></div>
				<div class="item-1">
					<p>杭州</p>
					<p>杭州</p>
					<p>杭州</p>
				</div>
				<div class="item-2">
					<p>成都</p>
					<p>成都</p>
					<p>成都</p>
				</div> -->
				<select name="province">
				 	 
				</select>
				<select class="ml-15" name="city">
					
				</select>
				<select class="ml-15" name="area">
					
				</select>
			</div>	
			<div class="introduce layout">
				<label><span>个人简介</span></label>
				<textarea name="" id="" class="lp-1" cols="30" rows="10" placeholder="请简单介绍一下你自己"></textarea>
			</div>
			<div class="weibo layout mt-101">
				<label><span>网站或微博</span></label>
				<input class="http fl" type="text" value="http://">
				<input class="gray-2 pl-10" type="text fl" value="weibo/194480395">
			</div>
			<div class="add mt-15">
				<a href="#"><p class="orange fs-16">继续添加</p></a>		
			</div>
			<div class="submit mt-15">
				<input type="submit" value="保存"/>
			</div>
			
			
		</div>
	</div>
	
	
</div>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/PCASClass.js" charset="gb2312"></script>
<script>
    new PCAS("province, 请选择省份", "city, 请选择城市", "area, 请选择地区");
</script>
<script>
	$("#info .column .info .menu li").mouseover(function(){
		$("#info .column .info .menu li .list").removeClass("active_2");
		$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
		$(this).children(".color-line").addClass("bg-orange-2");
		$(this).children(".list").addClass("active_2");
	}).mouseout(function(){
		$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
		$("#info .column .info .menu li .list").removeClass("active_2");
	});
</script>