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
                       <li>产品</li>
                       <li>观点</li>
                       <li>专栏</li>
                       <li>社区</li>
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
            <div class="navigation-cont">
                <div class="navigation-main">
                    <div class="navigation-left">
                        
                    </div>

                </div>
            </div>
        </div>

        <?= $content ?>

        <div id="bottom" class="column footer">
            <div class="footer-cont">
                <div class="footer-left">
                   <div class="footer-left-up">
                      左上 
                   </div> 
                   <div class="footer-left-down">
                      左下 
                   </div>
                </div>
                <div class="footer-mid">
                   中 
                </div>
                <div class="footer-right">
                   右 
                </div>
            </div>
            <div class="footer-bottom">
               <p class="footer-text">2013-2014 创新设计 浙ICP备13036478号-5</p> 
            </div>
        </div>        
    </div>
<?php $this->endBody() ?>
</body>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
</html>
<?php $this->endPage() ?>
