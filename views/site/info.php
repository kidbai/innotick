<div  id="info" class="wrapper">
	<div class="column">
		<div class="info col-15">
			<div class="img info-circle bg-pink fl ml-80 mt-45">
				<div class="avatar-circle">
				</div>
			</div>
			<div class="text fl ml-30 mt-65">
				<div class="fs-32 lp-4 wt"><?= user()->name?></div>
				<div class="fs-14 weibolink-color lp-1"><?= user()->url?></div>
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
					<div class="circle bg-orange fl">
						<!-- <img src="circle" alt=""> -->
					</div>
					<a href="#"><p class="orange fs-14">更改头像</p></a>
				</div>
				
			</div>	
			<div class="clear"></div>
			<div class="user-name layout">
				<label><span>用户名</span></label>
				<input id="user-name" type="text" value="<?= user()->name ?>" />
			</div>
			<div class="tel layout">
				<label><span>手机号码</span></label>
				<input id="user-phone" type="text" placeholder="绑定手机" value="<?= user()->phone ?>" maxlength="11" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
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
			</div>	
			<div class="area layout">
				<label><span>所在地区</span></label>
				
				<select id="address-province" name="province">
				</select>
				<select id="address-city" class="ml-15" name="city">

				</select>
				<select id="address-county" class="ml-15" name="county">
					
				</select>
			</div>	
			<div class="introduce layout">
				<label><span>个人简介</span></label>
				<textarea name="" id="" class="lp-1" cols="30" rows="10"><?= user()->desc?></textarea>
			</div>
			<div class="weibo layout mt-101">
				<label><span>网站或微博</span></label>
				<input class="http fl" type="text" value="http://">
				<input class="gray-2 pl-10" type="text fl" value="<?= user()->url?>">
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
<script type="text/javascript">

$("#info .column .info .menu li").mouseover(function(){
	$("#info .column .info .menu li .list").removeClass("active_2");
	$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
	$(this).children(".color-line").addClass("bg-orange-2");
	$(this).children(".list").addClass("active_2");
}).mouseout(function(){
	$("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
	$("#info .column .info .menu li .list").removeClass("active_2");
});


function saveinfo()
{
	var avatar = ''; //头像
	var username = $("#info .user-name input").val();
	var phone = $("#info .tel input").val();
	var gender = 0;
	var gender_val = $("#info .gender input[name='gender'][checked]").val();
	var desc = $("#info .introduce textarea").val();
	var url = $("#info .weibo input:eq(1)").val();
   	var province = $("#address-province").val();
   	var city = $("#address-city").val();
   	var county = $("#address-county").val(); 
    var data = {"phone": phone, "username":username, "province":province, "city":city, "county":county, "desc":desc, "url":url};
	$.ajax({
		url: '/user/user-save',
		type: 'POST',
		dataType: 'json',
		data:{ data:data, ';_csrf': global.csrfToken },
		success:function(data)
		{
			console.log("success");	
			console.log(data);
			alert("保存成功");
		}
	});
}

$(function(){


});


</script>