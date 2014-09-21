<?php
use yii\widgets\ActiveForm;

$section = '1-1';

$user_company_map = param('user-company-type');

$model->password = '';

?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />
<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/user-menu', ['section' => $section]) ?>
        </div>

        <input type="hidden" id="class-id" value="<?= $model->id ?>" />

        <div class="col-md-10">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal form-signin'],
                'fieldConfig' => [
                    'template' => "{label}<div class=\"col-sm-7\">{input}</div>\n<div class=\"error-msg col-sm-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-sm-1 control-label'],
                    'options' => ['class' => 'form-group '],
                ],
            ]); ?>
    
            <?= $form->field($model, 'name', ['inputOptions' => ['class' => 'form-control']]) ?>
            <div class="clear-2"></div>         

            <?= $form->field($model, 'phone', ['inputOptions' => ['class' => 'form-control']]) ?>
            <div class="clear-2"></div>      

            <?= $form->field($model, 'company', ['inputOptions' => ['class' => 'form-control']]) ?>
            <div class="clear-2"></div>

            <?= $form->field($model, 'company_position', ['inputOptions' => ['class' => 'form-control']]) ?>
            <div class="clear-2"></div>  

            <?= $form->field($model, 'desc', ['inputOptions' => ['class' => 'form-control']]) ?>
            <div class="clear-2"></div>  
        
            <?= $form->field($model, 'avatar', ['template' => '{label}{input}
                                                                <div class="col-sm-5 pl-15">
                                                                    <span class="btn btn-success fl file-upload-btn" >
                                                                        上传<input type="file" id="file-upload" name="file" />
                                                                    </span>
                                                                    <span class="fl file-upload-status" id="file-upload-status"></span>
                                                                    <div class="clear-10"></div>
                                                                    <img id="file-upload-img" width="150" height="150" src="/upload/img/'. $model->avatar .'" />
                                                                </div>'
                                                ])->hiddenInput() ?>

            <div class="clear-2"></div>
            <div class="form-group ">
                <div class="col-sm-offset-1 col-sm-2">
                    <button type="submit" class="btn btn-primary" >保存</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>        
    </div>
</div>

<div class="clear-40"></div>






<script type="text/javascript" src="/res/datetimepicker/moment.js"></script>
<script type="text/javascript" src="/res/datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/res/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>

<script type="text/javascript" src="/js/admin/user-edit.js"></script>




