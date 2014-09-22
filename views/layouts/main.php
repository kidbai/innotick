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
                       <a href="#"><li>产品</li></a>
                       <a href="#"><li>观点</li></a>
                       <a href="#"><li>专栏</li></a>
                       <a href="#"><li>社区</li></a>
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
                <div class="login">
                    <a href="javascript:;" class="btn">登陆</a>
                </div>
            </div>
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="navigation-left">
                        
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
    <script>
    $(function (){
        $("#post").each(function(){
            if($(this).mouseover()){
                $(this).addClass("bg-click");
            }
            if($(this).mouseout()){
                $(this).removeClass("bg-click");
            }
        });
    });
    </script>
<?php $this->endBody() ?>
</body>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</html>
<?php $this->endPage() ?>
