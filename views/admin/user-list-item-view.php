<?
use yii\helpers\Url;

$id = $model->id;
$edit_url = url(['/admin/user-edit', 'id' => $id]);

$user = $model;

?>
<tr id="user-<?= $id ?>">
    <td class="col col-action"><a href="<?= $edit_url ?>">编辑</a></td>
    <td class="col col-action"><a href="javascript:;" onclick="deletePost(<?=$id?>)">删除</a></td>
    <td class="col tc"><?= $id ?></td>
    <td class="col tc" name><?= $user->name ?></td>
    <td class="col tc"><?= $user->phone ?></td>
    <td class="col tc"><?= $user->company ?></td>
    <td class="col tc"><?= $user->company_position ?></td>
</tr>