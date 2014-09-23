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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <div id="top" class="column">
            <div class="nav">
                <div class="logo">
                    <a href="#"><img src="/img/icon/logo.png" height="80" width="80" alt=""/></a>
                </div>
                <div class="menu">
                   <ul>
                       <li><a class="fs-17" href="#">产品</a></li>
                       <li><a class="fs-17" href="#">观点</a></li>
                       <li><a class="fs-17" href="#">专栏</a></li>
                       <li><a class="fs-17" href="#">社区</a></li>
                   </ul>
                </div>
                
                <div class="search">
                    <div class="search-btn">
                       <a href=""><img src="/img/icon/search.png" height="30" width="30" alt=""/> </a>
                    </div>
                    <div class="field">
                        <input id="top-search-field" type="text" placeholder="搜索文章"/>
                    </div>
                </div>
                <div class="user fr">
                    <div class="info mt-20 ml-25">
                        <img class="fl ml-30 mt-10" src="#" width="20" height="20" alt=""/>
                        <a class="fs-14 orange fl ml-10" href="#">用户名</a> 
                    </div>
                    
                </div>
                <div class="item fr bg-orange">
                   <ul>
                        <li class="fs-17"><img src="/img/icon/homepage.png" width="20" height="20" alt=""><p>我的主页</p></li>
                        <li class="fs-14"><img src="/img/icon/notification.png" width="10" height="10" alt=""><p>通知中心</p></li>
                        <li class="fs-14"><img src="/img/icon/" width="10" height="10" alt=""><p>个人设置</p></li>
                        <li class="fs-14"><img src="/img/icon/save.png" width="10" height="10" alt=""><p>我的收藏</p></li>
                        <li class="fs-14"><img src="/img/icon/logout.png" width="10" height="10" alt=""><p>注销登陆</p></li>
                    </ul> 
                </div>
                <!--<div class="login">
                    <a href="javascript:;" class="btn">登陆</a>
                </div>-->
            </div>
            <!--<div class="carousel">
                <div class="carousel-inner">
                    <div class="navigation-left">
                        
                    </div>

                </div>
            </div>-->
        </div>

        <?= $content ?>

        <div id="bottom" class="column footer">
            <div class="cont">
                <div class="left">
                   <div class="left-up">
                        <div class="about">
                            <label class="fs-18 orange">关于我们</label>
                            <a class="fr fs-13 wt" href="#">了解更多>></a>
                        </div>
                        <p class="lightgray fl fs-14 lp-2">是一家全球视野的前沿科技媒体，提供关于中国于美国的最前沿科技创业资讯，致力于成为沟通者两个全球最大互联网/移动市场的互联网社区。</p>
                   </div> 
                   <div class="left-down">
                        <div class="about">
                            <label class="fs-18 orange">联系我们</label>
                            <a class="fr fs-13 wt" href="#">详细信息</a>
                        </div>
                        <p class="lightgray fl fs-14 lp-2">电话：400-633-5715</br>邮件：hi@chuangxinsheji.com</p>
                   </div>
                </div>
                <div class="mid">
                   <div class="about">
                       <label class="fs-18 orange">加入我们</label>
                       <a class="fr fs-13 wt" href="#">了解更多>></a>
                   </div>
                   <p class="lightgray fl fs-14 lp-2">我们欢迎那些聪明、热衷科技创新、视野开阔、反传统思维、能双语工作、行动力强、对创造高质量的科技新闻和评论充满兴趣的家伙加入团队，无论你在那里（不过北京与硅谷优先）。</p>
                </div>
                <div class="right">
                        <div class="about">
                            <label class="fs-18 orange">合作伙伴</label>
                        </div>
                        <p class="lightgray fl fs-14 lp-2">光华设计基金会</br>中国工业设计协会</br>创新设计工程实验室</br></p> 
                </div>
            
        </div>    
        <div class="bottom">
            <p class="text fs-12 wt">&copy;2013-2014 创新设计 浙ICP备13036478号-5</p> 
        </div>    
    </div>
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
    $(function(){
        $(".post").mouseover(function(){
         $(this).addClass("bg-click");
       });
        $(".post").mouseout(function(){
            $(this).removeClass("bg-click");
        });
        $(".user").mouseenter(function(){
            $(".user").addClass("bg-orange");
            $(".user a").removeClass("orange").addClass("wt");
            $(".item").show();
        });
        $(".user").mouseleave(function(){
            $(".user").removeClass("bg-orange");
            $(".user a").addClass("orange").removeClass("wt");
            $(".item").hide();
        });

    });
    </script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
