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
            <div class="logo">innotick</div>
        </div>

        <?= $content ?>

        <div id="bottom" class="column">
            <div class="logo">innotick</div>
        </div>        
    </div>
<?php $this->endBody() ?>
</body>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
</html>
<?php $this->endPage() ?>
