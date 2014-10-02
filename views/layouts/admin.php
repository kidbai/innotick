<?php
use yii\helpers\Html;
use yii\web\JqueryAsset;

$page = @app()->session['page'];

JqueryAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    
    <link href="/res/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/res/bootstrap/css/todc-bootstrap.css" rel="stylesheet" />
    <link href="/css/util.css" rel="stylesheet" />
    <link href="/css/admin.css" rel="stylesheet" />    

    <?php $this->head() ?>
    <script type="text/javascript" src="/res/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/admin/global.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>    
    
</head>
<body>

    <ul id="top-nav" class="nav nav-tabs nav-tabs-google">
        <li><span href="javascript:;" id="logo">后台管理</span></li>
        <li id="nav-5" class="nav-item <? if ($page == 1) echo 'active'; ?>"><a href="/admin/post">文章管理</a></li>
    </ul>


    <ul id="top-right" class="nav navbar-nav navbar-right">
        <li class="user-info">欢迎，<span id="username"></span></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">操作 <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="javascript:;" onclick="changeAdminPassword()">修改密码</a></li>
                <li><a href="/admin/logout">退出</a></li>
            </ul>
        </li>
    </ul>    

<?php $this->beginBody() ?>
    <div class="wrap">
        <?= $content ?>
    </div>


<!-- Modal -->
<div class="modal fade" id="adminChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="admin-title">修改密码</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" role="form">
                    <input type="hidden" id="admin-id" />

                    <div class="form-group col-md-8">
                        <label class="col-sm-5 control-label">旧密码</label>
                        <div class="col-sm-7 input-group">
                            <input type="password" class="form-control" id="global-admin-password-old" placeholder="">
                        </div>
                    </div>
                    <div class="clear-0"></div>

                    <div class="form-group col-md-8">
                        <label class="col-sm-5 control-label">密码</label>
                        <div class="col-sm-7 input-group">
                            <input type="password" class="form-control" id="global-admin-password" placeholder="">
                        </div>
                    </div>
                    <div class="clear-0"></div>


                    <div class="form-group col-md-8">
                        <label class="col-sm-5 control-label">重复密码</label>
                        <div class="col-sm-7 input-group">
                            <input type="password" class="form-control" id="global-admin-password-again" placeholder="">
                        </div>
                    </div>
                    <div class="clear-0"></div>

                </div>

                <div class="clear-10"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveAdminPassword()">保存</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var global = global ? global : {};
global.page = parseInt("<?= app()->session['page'] ?>");
// app()->request->csrfToken 
global.csrfToken = '';
</script>    

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
