<?
use yii\helpers\Url;

$post = $model;

$id = $model->id;
$edit_url = url(['/admin/post-edit', 'id' => $id]);
$view_url = url(['/res/pdf', 'file' => $post->content]);




?>
<tr id="post-<?= $id ?>">
	<td class="col col-action"><a href="<?= $edit_url ?>">编辑</a></td>
	<td class="col col-action"><a href="javascript:;" onclick="deletePost(<?=$id?>)">删除</a></td>
	<td class="col tc"><?= $id ?></td>
	<td class="col tc"><a href="<?= $view_url ?>" class="title" target="_blank"><?= $post->name ?></a></td>

</tr>