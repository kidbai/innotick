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
    <td class="col tc"><?= $user->email ?></td>
    <td class="col tc"><?= $user->username ?></td>
    <td class="col tc"><?= $user->password ?></td>
    <td class="col tc"><?= $user->name ?></td>
    <td class="col tc"><?= $user->gender ?></td>
    <td class="col tc"><?= $user->phone ?></td>
    <td class="col tc"><?= $user->province ?></td>
    <td class="col tc"><?= $user->city ?></td>
    <td class="col tc"><?= $user->county ?></td>
    <td class="col tc"><?= $user->avatar ?></td>
    <td class="col tc"><?= $user->url ?></td>
    <td class="col tc"><?= $user->desc ?></td>
</tr>