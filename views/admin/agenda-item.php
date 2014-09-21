<?
$id = $module['id'];
$type = $module['type'];
$name = $module['name'];
$time = $module['time'];

$type_map = [
	'1' => '开始会议',
	'2' => '选择议题',
	'3' => '阐述议题',
	'4' => '反馈',
	'5' => '休息',
	'6' => '自我介绍',
	'7' => '自我总结',
	'8' => '分享建议',
	'9' => '议题探究'
];

$child = @$module['child'];
if (!is_array($child))
{
	$child = [];
}
?>
<li id="module-<?= $id ?>" class="module" data-id="<?= $id ?>" data-type="<?= $type ?>" data-name="<?= $name ?>" data-time="<?= $time ?>" >
	<div class="info">
		<div class="item">模块名：<span class="name"><?= $name ?></span></div>
		<div class="item">时间：<span class="time"><?= $time ?></span>分钟</div>
		<div class="item">类型：<span class="type"><?= $type_map[$type] ?></span></div>
	</div>
	<div class="action-holder">
		<a class="action fs-20" title="添加子模块" href="javascript:;" onclick="addChildModule(<?= $id ?>)"><i class="fa fa-plus-square"></i></a>
		<a class="action fs-20" title="编辑模块" href="javascript:;" onclick="editModule(<?= $id ?>)"><i class="fa fa-edit"></i></a>
		<a class="action fs-20" title="删除模块" href="javascript:;" onclick="removeModule(<?= $id ?>)"><i class="fa fa-remove"></i></a>
	</div>
	<div class="clear-5"></div>
	<ul class="child-holder">
	<?
	foreach ($child as $c)
	{
		echo $this->render('/admin/agenda-child-item', ['id' => $id, 'child' => $c]);
	}
	?>
	</ul>
	<div class="clear-1"></div>
</li>