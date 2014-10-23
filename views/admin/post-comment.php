<?php
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\PostComment;

$section = '1-' . $category_id;

$model->category_id = $category_id;
$post = $model;
?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />
<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/post-menu', ['section' => $section, 'category' => $category]) ?>
        </div>

        <input type="hidden" id="class-id" value="<?= $model->id ?>" />

        <div class="col-md-10">
            <table class="table table-bordered">
                <tr>
                    <th class="tc">评论ID</td>
                    <th class="tc">评论内容</td>
                </tr>
                <?
                    foreach ($post->comment as $comment)
                    {
                ?>
                    <tr>
                        <td class="tc"><?= $comment->id?></td>
                        <td class="tc"><?= $comment->content?></td>
                    </tr>
                <?
                    }
                ?>
            </table>
        </div>        
    </div>
</div>

<div class="clear-40"></div>






<script type="text/javascript" src="/res/datetimepicker/moment.js"></script>
<script type="text/javascript" src="/res/datetimepicker/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/res/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<script type='text/javascript' charset="utf-8" src="/res/kindeditor/kindeditor-min.js"></script>
<script type='text/javascript' charset="utf-8" src="/res/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>

<script type="text/javascript" src="/js/admin/post-edit.js"></script>




