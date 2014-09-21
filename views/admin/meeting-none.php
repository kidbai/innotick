<?php
use yii\widgets\ActiveForm;

$section = '';
?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => $section]) ?>
        </div>
    </div>
</div>