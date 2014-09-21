<?
$child_id = $child['id'];
$child_name = $child['name'];
$child_type = $child['type'];
$child_pid = $child['pid'];
$child_time = $child['time'];

$child_type_map = [
	'1' => '问卷',
	'2' => '投票',
	'3' => '文章',
];
?>
<li id="module-<?= $id ?>-<?= $child_id ?>" class="child" data-id="<?= $child_id ?>" data-type="<?= $child_type ?>" data-pid="<?= $child_pid ?>" data-name="<?= $child_name ?>" data-time="<?= $child_time ?>"  >
	<div class="info">
		<div class="item">子模块名：<span class="child-name"><?= $child_name ?></span></div>
		<div class="item">子模块时间：<span class="child-time"><?= $child_time ?></span>分钟</div>
		<div class="item">子模块类型：<span class="child-type"><?= $child_type_map[$child_type] ?></span></div>
	</div>
	<div class="action-holder">
		<a class="action fs-20" title="编辑模块" href="javascript:;" onclick="editChildModule(<?= $id ?>, <?= $child_id ?>)"><i class="fa fa-edit"></i></a>
		<a class="action fs-20" title="删除模块" href="javascript:;" onclick="removeChildModule(<?= $id ?>, <?= $child_id ?>)"><i class="fa fa-remove"></i></a>			
	</div>
</li>