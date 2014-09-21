<?php
use yii\widgets\ListView;
use app\component\BootstrapPager;

$section = '1-2';

?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/user-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-10">

    </div>
</div>