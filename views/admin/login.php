<?php
use yii\widgets\ActiveForm;



?>

<link rel="stylesheet" href="/css/login.css?v=<? echo param('version'); ?>" />
<div class="clear-80"></div>  
<div class="container">

  <h2 class="form-signin-heading text-center">管理后台</h2>
  <div class="clear-15"></div>

  <div class="card card-signin">
    <img class="img-circle profile-img" src="/img/avatar.png" alt="">
    	<?php

    	$msg = null;
		if ($msg)
		{
		?>
			<div class="mt-30 alert alert-danger hide"><?=$msg?></div>
		<?
		}
		?>

	    <?php $form = ActiveForm::begin([
	        'id' => 'login-form',
	        'options' => ['class' => 'form-horizontal form-signin'],
	        'fieldConfig' => [
	            'template' => "{input}\n<div class=\"error-msg\">{error}</div>",
	            'labelOptions' => ['class' => 'col-lg-1 control-label'],
	        ],
	    ]); ?>

	    <?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => '用户名', 'class' => 'form-control']]) ?>

	    <?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => '密码', 'class' => 'form-control']])->passwordInput() ?>

		<button type="submit" class="btn btn-lg btn-primary btn-block" >登录</button>			

		<?php ActiveForm::end(); ?>

  </div>
  <div class="clear-40"></div>  
</div> <!-- /container -->
