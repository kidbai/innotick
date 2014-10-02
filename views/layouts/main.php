<?php
use yii\helpers\Html;
use yii\web\JqueryAsset;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link href="/css/util.css" rel="stylesheet" />
    <link href="/css/base.css" rel="stylesheet" />
    <link href="/res/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!--遮罩-->
<div class="shade"></div>
    
    <!-- 登陆窗口 -->
    <div id="lg-window" class="login-window">
        <div class="lg-window-login">
            <div class="login up">
                <div class="close fr">
                    <i class="fa fa-times"></i>
                </div>
                <div class="clear"></div>
                <div class="no-sign-in fs-20">
                    无需注册，直接使用社交账号登陆
                </div>
                <div class="weibo"><img src="/img/icon/sina.png" width="25" heigh="20" alt=""/><div class="fr weibo-text">微博</div></div>
                <div class="weixin"><img src="/img/icon/wechat.png" width="25" heigh="20" alt=""><div class="fr weixin-text">微信</div></div>
            </div>
            <div class="solid-line"></div>
            <div class="login-input mid mt-20">
                <div class="id">
                    <div class="id-img fl">
                        <img class="fl" src="/img/icon/user.png" alt=""/>
                    </div>
                    <input class="fl" type="text" placeholder="用户名或邮箱"/>
                </div>
                <div class="clear"></div>
                <div class="password mt-20">
                    <div class="password-img fl">
                        <img class="fl" src="/img/icon/key.png" alt=""/>
                    </div>
                    <input class="fl" type="password" placeholder="密码"/>
                </div>
                <div class="clear"></div>
                <div class="info fl">
                    <div class="fl fs-16 forget-password">
                        忘记密码
                    </div>
                    <div class="login-btn fr">
                        登录
                    </div>
                </div>
            </div>
            <div class="solid-line"></div>
            <div class="other bottom">
                <div class="no-id fs-16 fl">没有账号</div>
                <div class="sign-in fs-16 fl">注册</div>
            </div>
        </div>

        <!-- 注册窗口  -->
        <div class="lg-window-signin">
            <div class="login up">
                <div class="close fr">
                    <i class="fa fa-times"></i>
                </div>
                <div class="clear"></div>
                <div class="no-sign-in fs-20">
                    无需注册，直接使用社交账号登陆
                </div>
                <div class="weibo"><img src="/img/icon/sina.png" width="25" heigh="20" alt=""/><div class="fr weibo-text">微博</div></div>
                <div class="weixin"><img src="/img/icon/wechat.png" width="25" heigh="20" alt=""><div class="fr weixin-text">微信</div></div>
            </div>
            <div class="solid-line"></div>
            <div class="signin-input fl mt-20">
               <div class="id">
                    <div class="id-img signin-input-item fl">
                        <img class="fl" src="/img/icon/user.png" alt=""/>
                    </div>
                    <input class="fl" type="text" placeholder="用户名 英文或数字"/>
                </div> 
                <div class="clear"></div>
                <div class="email mt-20">
                    <div class="email-img signin-input-item fl">
                        <img src="/img/icon/email.png" alt="" class="fl">
                    </div>
                    <input type="text" class="fl" placeholder="邮箱"/>
                </div>
                <div class="clear"></div>
                <div class="password mt-20">
                    <div class="password-img signin-input-item fl">
                        <img src="/img/icon/key.png" alt="" class="fl">
                    </div>
                    <input type="text" class="fl" placeholder="密码"/>
                </div>
                <div class="clear"></div>
                <div class="signin-bottom">
                    <div class="no-id fs-16 fl">已有账号?</div>
                    <div class="sign-in fs-16 fl">登陆</div>
                    <div class="login-btn fr">
                        登录
                    </div>
                </div>
            </div>
        </div>
        <!--  忘记密码 --> 
        <div class="fpassword">
           <div class="login fup">
                <div class="fpassword-text fl fs-20 lp-1">
                    忘记密码 
                </div>
                <div class="back fl">
                    <img class="fl" src="/img/icon/return.png" width="16" height="21" alt=""/>
                    <div class="fl fs-16 lp-1 ml-6">返回</div>
                </div>
           </div> 
           <div class="mid">
               <div class="label fl fs-16 ml-40">
                   输入邮箱
               </div>
               <div class="clear"></div>
               <input type="text">
               <div class="clear"></div>
               <div class="text mt-40 fs-12 ml-40 lp-1">
                    此功能将会发送一个找回密码的特别链接到您的邮箱，通过改链接可以进入重置密码的页面。
               </div>
           </div>
           <div class="clear"></div>
           <div class="fp-btn">
                找回密码 
           </div>
        </div>
    </div>
    <div class="wrapper">
        <div id="top" class="column">
            <div class="nav">
                <div class="logo">
                    <a href="#"><img src="/img/icon/logo.png" height="80" width="80" alt=""/></a>
                </div>
                <div class="menu">
                   <ul>
                       <li>
                            <div class="nav-item-list">
                                <div class="fl nav-item">产品</div>
                                <img class="fl" src="/img/icon/dropdown.png" alt=""/>
                            </div>
                           
                       </li>
                       <li>
                            <div class="nav-item-list">
                                <div class="nav-item">观点</div>
                            </div>
                        </li>
                       <li>
                            <div class="nav-item-list">
                                <div class="fl nav-item">专栏</div>
                                <img class="fl" src="/img/icon/dropdown.png" alt=""/>
                            </div>
                        </li>
                       <li>
                            <div class="nav-item-list">
                                <div class="nav-item">社区</div>
                            </div>
                        </li>
                   </ul>
                </div>  

                <div class="search">
                    <div class="search-btn">
                       <a href=""><img src="/img/icon/search.png" height="25" width="25" alt=""/> </a>
                    </div>
                    <div class="field">
                        <input id="top-search-field" type="text" placeholder="搜索文章"/>
                    </div>
                </div>
                <div class="user fr">
                    <div class="info mt-20 ml-25">
                        <img class="fl ml-30 mt-10" src="/img/icon/user.png" width="20" height="20" alt=""/>
                        <a class="fs-14 orange fl ml-10" href="#">用户名</a> 
                    </div>
                    
                </div>
                
                <div class="login">
                    <a class="btn lp-1">登录</a>
                </div>
            </div>
            <div class="item fr bg-orange">
                <ul>
                    <li><img class="fl ml-52 mt-7" src="/img/icon/homepage.png" width="20" height="20" alt=""><a class="fl fs-14 sw pt-4 ml-17" href="#">我的主页</a></li>
                    <li><img class="fl ml-52 mt-7" src="/img/icon/notification.png" width="20" height="20" alt=""><a class="fl fs-14 sw pt-4 ml-17" href="#">通知中心</a></li>
                    <li><img class="fl ml-52 mt-7" src="/img/icon/settings.png" width="20" height="20" alt=""><a class="fl fs-14 sw pt-4 ml-17" href="#">个人设置</a></li>
                    <li><img class="fl ml-52 mt-7" src="/img/icon/save.png" width="20" height="20" alt=""><a class="fl fs-14 sw pt-4 ml-17" href="#">我的收藏</a></li>
                    <li><img class="fl ml-52 mt-7" src="/img/icon/log-out.png" width="20" height="20" alt=""><a class="fl fs-14 sw pt-4 ml-17" href="#">注销登录</a></li>
                </ul> 
            </div>
            <!--<div class="carousel">
                <div class="carousel-inner">
                    <div class="navigation-left">
                        
                    </div>

                </div>
            </div>-->
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="previous fl">
                        <img src="/img/icon/left.png" alt=""/>
                    </div>
                    <div class="content-product fl">
                        <ul>
                            <li class="ml-30">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                            <li class="ml-100">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                            <li class="ml-100">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                            <div class="clear"></div>
                            <li class="ml-30">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                            <li class="ml-100">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                            <li class="ml-100">
                               <div class="product-list"></div> 
                               <div class="product-text fs-12">总部在韩国首尔的创业公司</div>
                            </li>
                        </ul>
                    </div>
                    <div class="content-special">
                        <ul>
                            <li class="ml-30 special-list">
                                <div class="website imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="website-text fl ml-10">
                                    <p class="fs-20 mb-5">网站</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>
                            </li>
                            <li class="ml-100 special-list">
                                <div class="app imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="app-text fl ml-10">
                                    <p class="fs-20 mb-5">应用</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>
                            </li>
                            <li class="ml-100 special-list">
                                <div class="hardware imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="hardware-text fl ml-10">
                                    <p class="fs-20 mb-5">硬件</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>
                            </li>
                            <div class="clear"></div>
                            <li class="ml-30 special-list">
                                <div class="brand imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="brand-text fl ml-10">
                                    <p class="fs-20 mb-5">品牌</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>                                    
                            </li>
                            <li class="ml-100 special-list">
                                <div class="idea imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="idea-text fl ml-10">
                                    <p class="fs-20 mb-5">品牌</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>
                            </li>
                            <li class="ml-100 special-list">
                                <div class="viewpoint imgbcolor fl">
                                    <img src="/img/icon/icon1.png" width="50" height="50" alt=""/> 
                                </div>
                                <div class="viewpoint-text fl ml-10">
                                    <p class="fs-20 mb-5">观点</p>
                                    <p class="fs-14">PC互联网项目</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="next fr">
                        <img src="/img/icon/right.png" alt="">
                    </div>
                </div>
            </div>
            

        </div>

        <?= $content ?>

        <div id="bottom" class="column footer">
            <div class="cont">
                <div class="left">
                   <div class="left-up">
                        <div class="about">
                            <label class="fs-18 orange lp-1">关于我们</label>
                            <a class="fr fs-14 wt mt-5 lp-1" href="#">了解更多>></a>
                        </div>
                        <div class="lightgray fl fs-13 lp-2 about-content">是一家全球视野的前沿科技媒体，提供关于中国于美国的最前沿科技创业资讯，致力于成为沟通者两个全球最大互联网/移动市场的互联网社区。</div>
                   </div> 
                   <div class="left-down">
                        <div class="about">
                            <label class="fs-18 orange">联系我们</label>
                            <a class="fr fs-14 wt mt-5" href="#">详细信息>></a>
                        </div>
                        <div class="lightgray fl fs-14 lp-1 about-content">电话：400-633-5715</br>邮件：hi@chuangxinsheji.com</div>
                   </div>
                </div>
                <div class="mid">
                   <div class="about">
                       <label class="fs-18 orange">加入我们</label>
                       <a class="fr fs-14 wt mt-5" href="#">了解更多>></a>
                   </div>
                   <div class="lightgray fl fs-14 lp-2 about-content">我们欢迎那些聪明、热衷科技创新、视野开阔、反传统思维、能双语工作、行动力强、对创造高质量的科技新闻和评论充满兴趣的家伙加入团队，无论你在那里（不过北京与硅谷优先）。</div>
                </div>
                <div class="right">
                        <div class="about">
                            <label class="fs-18 orange">合作伙伴</label>
                        </div>
                        <div class="lightgray fl fs-14 lp-1 about-content">光华设计基金会</br>中国工业设计协会</br>创新设计工程实验室</br></div> 
                </div>
            </div>    
            <div class="bottom">
                <p class="text fs-14 wt">&copy;2013-2014 创新设计 浙ICP备13036478号-5</p> 
            </div>    
        </div>
<script src="/js/jquery-1.11.1.min.js"></script>
    
<script>
    
    $("#top .nav .menu li .nav-item-list").mouseover(function(){
       // $("#top .nav .menu li img").prop("src","/img/icon/dropdown-light.png");
       $(this).children("img").prop("src","/img/icon/dropdown-light.png");
    }).mouseout(function(){
       $(this).children("img").prop("src","/img/icon/dropdown.png");
    });

    $(".user").mouseenter(function(e){
            $(".user").addClass("bg-orange");
            $(".user a").removeClass("orange").addClass("sw");
            $(".item").show();
    }),$(".user").mouseleave(function(e){
        if(e.offsetX < 0 || e.offsetX > 200 || e.offsetY < 0){
            $(".user").removeClass("bg-orange");
            $(".user a").addClass("orange").removeClass("sw");
            $(".item").hide();
        }
    });
    
    $(".item").mouseleave(function(e){
        console.log(e);
        if(e.offsetX < 0 || e.offsetX > 200 || e.offsetY > 36){
            $(".user").removeClass("bg-orange");
            $(".user a").addClass("orange").removeClass("sw");
            $(".item").hide();
        }
    });
    $(".item li").each(function(){
        $(this).mouseover(function(){
            $(this).addClass("nav-active");
        });
        $(this).mouseout(function(){
            $(this).removeClass("nav-active");
        });
    });

    $("#top .carousel li").mouseover(function(){
        $(this).children("p").addClass("orange");
    }).mouseout(function(){
        $(this).children("p").removeClass("orange");
    });
    
    $("#top .nav .menu li:eq(0) .nav-item").mouseenter(function(){
        $("#top .carousel .content-product").addClass("on");
        $("#top .carousel").slideDown("fast");
    }).mouseleave(function(e){
        if(e.offsetX < -1 || e.offsetY < -3 || e.offsetX > 40 )
        {
            $("#top .carousel .content-product").removeClass("on");
            $("#top .carousel").slideUp("fast");
        }
    });
    $("#top .nav .menu li:eq(2) .nav-item").mouseenter(function(){
        $("#top .carousel .content-special").addClass("on");
        $("#top .carousel").slideDown("fast");
    }).mouseleave(function(e){
        console.log(e);
        if(e.offsetX < -1 && e.offsetY < 90 || e.offsetX > 46 && e.offsetY < 90)
        {
            $("#top .carousel .content-special").removeClass("on");
            $("#top .carousel").slideUp("fast");
        }
    });

    $("#top .carousel").mouseleave(function(e){
        if(e.offsetX < 0 || e.offsetX > 1200 || e.offsetY > 320 || e.offsetY < -10  )
        {
            $("#top .carousel").slideUp("fast");
        }
    });

    //创建登陆窗口
    $("#top .nav .login .btn").click(function(){
        console.log($("#lg-window"));
        if(!$("#lg-window").hasClass("on"))
        {
            $("#lg-window").addClass("on");
            $(".shade").show();
        }
    });
    //窗口遮罩
    $("#lg-window .login .close").click(function(){
        $("#lg-window .lg-window-signin").removeClass("on"); 
        $("#lg-window .lg-window-login").removeClass("on"); 
        $("#lg-window .fpassword").removeClass("on");
        if($("#lg-window").hasClass("on"))
        {
            $("#lg-window").removeClass("on");
            $("#lg-window .lg-window-signin").removeClass("on");
            $("#lg-window .fpassword").removeClass("on");
            $(".shade").hide();
        }
    });
    $(".shade").click(function(){
        $("#lg-window").removeClass("on");
        $("#lg-window .lg-window-login").removeClass("on");
        $("#lg-window .lg-window-signin").removeClass("on"); 
        $("#lg-window .fpassword").removeClass("on");
        $(".shade").hide();
        console.log("shade hide");
    });   

    //注册
    $("#lg-window .bottom .sign-in").click(function(){
        $("#lg-window .lg-window-login").addClass("on");
        $("#lg-window .lg-window-signin").addClass("on");
    });
    //登陆
    $("#lg-window .lg-window-signin .signin-input .signin-bottom .sign-in").click(function(){
        $("#lg-window .lg-window-signin").removeClass("on");
        $("#lg-window .lg-window-login").removeClass("on");
    });
    //忘记密码
    $("#lg-window .mid .forget-password").click(function(){
        $("#lg-window .lg-window-login").addClass("on");
        $("#lg-window .fpassword").addClass("on");
    });

    $("#lg-window .fpassword .back").click(function(){
        $("#lg-window .fpassword").removeClass("on");
        $("#lg-window .lg-window-login").removeClass("on");
    });


</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
