<?
use yii\helpers\Url;
use app\models\Post;
use app\component\DXConst;

$id = $model->id;
$edit_url = url(['/admin/post-edit', 'id' => $id]);
$view_url = $model->url;


$post = $model;

?>
<tr id="post-<?= $id ?>">
    <td class="col col-action"><a href="<?= $edit_url ?>">编辑</a></td>
    <td class="col col-action"><a href="javascript:;" onclick="deletePost(<?=$id?>)">删除</a></td>
    <td class="col col-action"><?= $id ?></td>
    <td class="col col-action"><a href="<?= $view_url ?>" class="title" target="_blank"><?= $model->title ?></a></td>
    <td class="col tc"><?= timeFormat($model->created) ?></td>
    <td class="col tc"><?= timeFormat($model->updated) ?></td>
    <td class="col tc"><?= @$post->admin->username ?></td>

</tr>