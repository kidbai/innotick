<div  id="info" class="wrapper">
	<div class="column">
		<div class="info col-15">
			<div class="img info-circle bg-orange fl ml-80 mt-45">
				<img class="avatar-circle" src="/upload/img/<?= user()->avatar?>" width="100" height="100" alt="">
			</div>
			<div class="text fl ml-30 mt-65">
				<div class="fs-32 lp-4 wt"><?= user()->name?></div>
				<div class="fs-14 weibolink-color lp-1"><?= user()->url?></div>
			</div>
			<div class="menu ml-80">
				<ul>
					<li>
						<div class="color-line bg-orange"></div>
						<div class="list bg-wt active"><a href="/user/info"><div class="fs-17 orange">基本信息</div></a></div>
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
						<div class="list bg-wt"><a href="/user/favorite-post"><div class="fs-17 orange">我的收藏</div></a></div>
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
				<input type="text" id="email_addr" value="<?= user()->email?>"/>
				<div class="fl can-not-null" id="error-email">不能为空</div>
			</div>
			<div class="avatar layout">
				<label><span>头像</span></label>
				<div class="img">
					<div class="circle fl">
						<img class="circle" id="file-upload-img" width="106" height="106" src="/upload/img/<?= user()->avatar?> "/>
					</div>
					<!-- <a href="#"><p class="orange fs-14">更改头像</p></a>
					<span class="img-upload" >
						更改头像<input type="file" id="file-upload" name="file" />
					</span>  -->
					<span class="btn btn-success fl file-upload-btn img-upload" >
						更改头像<input type="file" id="file-upload" name="file" />
					</span>
					<span class="fl file-upload-status" id="file-upload-status"></span>
					<div class="fl can-not-null" id="error-avatar">不能为空</div>
					<div class="clear-10"></div>
					<input type="hidden" id="user-avatar" class="form-control" value="<?= user()->avatar?>">
					
				</div>
				
			</div>	
			<div class="clear"></div>
			<div class="user-name layout">
				<label><span>用户名</span></label>
				<input id="user-name" type="text" value="<?= user()->name ?>" />
				<div class="fl can-not-null" id="error-name">不能为空</div>
			</div>
			<div class="tel layout">
				<label><span>手机号码</span></label>
				<input id="user-phone" type="text" placeholder="绑定手机" value="<?= user()->phone ?>" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
				<div class="fl can-not-null" id="error-phone">不能为空</div>
				<!-- <div class="getcode"><p class="wt fs-14">获取免费短信验证码</p></div> -->
			</div>	
			<!-- <div class="mscode layout">
				<label><span>短信验证码</span></label>
				<input type="text" placeholder="5位数字" maxlength="5"/>
			</div>	 -->
			<div class="gender layout">
				<label><span>性别</span></label>
				<input type="radio" name="gender" <? if (user()->gender == 0) echo 'checked="checked"'; ?> value="0"/><p class="fl fs-15 ml-5 mr-10">男</p>
				<input type="radio" name="gender" <? if (user()->gender == 1) echo 'checked="checked"'; ?> value="1"/><p class="fl fs-15 ml-5 mr-10">女</p>
				<input type="radio" name="gender" <? if (user()->gender == 2) echo 'checked="checked"'; ?> value="2"/><p class="fl fs-15 ml-5 mr-10">保密</p>
				<div class="fl can-not-null" id="error-gender">不能为空</div>
			</div>	
			<div class="county layout">
				<label><span>所在地区</span></label>
				<select id="address-province" name="province">
				</select>
				<select id="address-city" class="ml-15" name="city">
				</select>
				<select id="address-county" class="ml-15" name="county">
				</select>
				<div class="fl can-not-null" id="error-county">不能为空</div>
			</div>	
			<div class="introduce layout">
				<label><span>个人简介</span></label>
				<textarea name="" id="desc-info" class="lp-1 fl" cols="30" rows="10"><?= user()->desc?></textarea>
				<div class="fl can-not-null" id="error-desc">不能为空</div>
			</div>
			<div class="weibo layout mt-101">
				<label><span>网站或微博</span></label>
				<input class="http fl" type="text" value="http://">
				<input class="gray-2 pl-10" id="url-addr" type="text fl" value="<?= user()->url?>">
				<div class="fl can-not-null" id="error-url">不能为空</div>
			</div>
			<div class="add mt-15">
				<a href="#"><p class="orange fs-16">继续添加</p></a>		
			</div>
			<div class="submit mt-15">
				<input type="submit" value="保存" onclick="saveinfo()"/>
			</div>
			
			
		</div>
	</div>
	
	
</div>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/PCASClass.js" charset="gb2312"></script>
<script>
new PCAS("province=<?= user()->province ?>,请选择省份","city=<?= user()->city ?>,请选择城市","county=<?= user()->county ?>,请选择地区");
</script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/admin/upload.js"></script>
<script type="text/javascript" src="/js/info.js"></script>
