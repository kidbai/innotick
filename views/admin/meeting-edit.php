<?php
use yii\widgets\ActiveForm;
use app\component\DXConst;

$section = '1-1';
?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => $section]) ?>
        </div>

		<div class="col-md-6">
 

            <?php $form = ActiveForm::begin([
		        'id' => 'login-form',
		        'options' => ['class' => 'form-horizontal form-signin'],
		        'fieldConfig' => [
		            'template' => "{label}<div class=\"col-sm-6\">{input}</div>\n<div class=\"error-msg col-sm-4\">{error}</div>",
		            'labelOptions' => ['class' => 'col-sm-2 control-label'],
		            'options' => ['class' => 'form-group '],
		        ],
		    ]); ?>

            <div class="form-group ">
                <div class="col-sm-offset-2 col-sm-8">
                    <h4>会议基本信息</h4>
                </div>
            </div>            
            <div class="clear-2"></div>

		    <?= $form->field($model, 'name', ['inputOptions' => ['class' => 'form-control']]) ?>
		    <div class="clear-2"></div>	

			<?= $form->field($model, 'desc', ['inputOptions' => ['class' => 'form-control']]) ?>
		    <div class="clear-2"></div>			    

		    <?= $form->field($model, 'time', ['inputOptions' => ['class' => 'form-control', 'placeholder' => '分钟']]) ?>
		    <div class="clear-2"></div>	

            <?
            if ($model->status = DXConst::MEETING_STATUS_VALID)
            {
                // , 'disabled' => 'disabled'
                echo $form->field($model, 'agenda_id', ['inputOptions' => ['class' => 'form-control']])->dropDownList($agenda_list);
            }
            else
            {
                echo $form->field($model, 'agenda_id', ['inputOptions' => ['class' => 'form-control']])->dropDownList($agenda_list);
            }
                 
            ?>
            <div class="clear-2"></div> 		    	    

		    <div class="clear-2"></div>
			<div class="form-group ">
                <div class="col-sm-offset-2 col-sm-2">
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
<script type='text/javascript' charset="utf-8" src="/res/kindeditor/kindeditor-min.js"></script>
<script type='text/javascript' charset="utf-8" src="/res/kindeditor/zh_CN.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>

<script type="text/javascript" src="/js/admin/post-edit.js"></script>




