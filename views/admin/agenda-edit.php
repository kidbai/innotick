<?
$config = json_decode($agenda->data, true);
if (!$config)
{
	$config = [];
}

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

$child_type_map = [
	'1' => '问卷',
	'2' => '投票',
	'3' => '文章',
];
?>

<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css?v=<? echo param('version'); ?>" />

<script type="text/javascript">
var agenda_id = <?= $agenda->id ? $agenda->id : 0 ?>;
var type_map = <?= json_encode($type_map) ?>;
var child_type_map = <?= json_encode($child_type_map) ?>;
</script>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => '1-3']) ?>
        </div>

		<div class="col-md-10">
			<a class="btn btn-primary" href="javascript:;" onclick="save()" >保存</a>
			<div class="clear-30"></div>			

			<div class="input-group col-md-3" style="padding-left: 0px; padding-right: 0px;">
              	<input type="text" id="agenda-name" value="<?= $agenda->name ?>" placeholder="议程配置名" class="form-control">
            </div>
            <div class="clear-10"></div>          

			<a class="btn btn-success" href="javascript:;" onclick="addModule()" >添加模块</a>
			<div class="clear-10"></div>
			<ul id="module-holder">
				<?
				foreach ($config as $module)
				{
					echo $this->render('/admin/agenda-item', ['module' => $module]);
				}
				?>
			</ul>
		</div>
	</div>
</div>




<!-- Modal -->
<div class="modal fade" id="moduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">	    	
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">模块</h4>
            </div>
            <input type="hidden" id="module-id" />
            <div class="modal-body">
            	<div class="form-horizontal" >
            		<div class="clear-5"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">模块名称</label>
						<div class="col-sm-6"><input type="text" id="module-name" class="form-control" placeholder="名称"></div>
					</div>
					<div class="clear-5"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">模块类型</label>
						<div class="col-sm-8">
							<select id="module-type">
							<?
							foreach ($type_map as $key => $type)
							{
							?>
								<option value="<?= $key ?>"><?= $type ?></option>
							<?
							}
							?>
							</select>
						</div>
					</div>
					<div class="clear-5"></div>					

					<div class="form-group">
						<label class="col-sm-2 control-label">模块时间</label>
						<div class="col-sm-6 input-group" >
							<input type="text" id="module-time" class="form-control">
							<span class="input-group-addon">分钟</span>
						</div>
					</div>	
					<div class="clear-5"></div>				
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveModule()">保存</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="childModuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">	    	
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">子模块</h4>
            </div>
            <input type="hidden" id="parent-module-id" />
            <input type="hidden" id="child-module-id" />
            <div class="modal-body">
            	<div class="form-horizontal" >
            		<div class="clear-5"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">子模块名称</label>
						<div class="col-sm-6"><input type="text" id="child-module-name" class="form-control" placeholder="名称"></div>
					</div>
					<div class="clear-5"></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">子模块类型</label>
						<div class="col-sm-8">
							<select id="child-module-type" onchange="childModuleTypeChanged()">
								<option value="1">问卷</option>
								<option value="2">投票</option>
								<option value="3">文章</option>
							</select>
						</div>
					</div>
					<div class="clear-5"></div>	

					<div id="questionnaire-selector" class="form-group hide selector">
						<label class="col-sm-2 control-label">问卷</label>
						<div class="col-sm-8">
							<select id="questionnaire-id" name="q">
							<?
							foreach ($questionnaire_list as $questionnaire)
							{
							?>
								<option value="<?= $questionnaire['id'] ?>"><?= $questionnaire['name'] ?></option>
							<?
							}
							?>
							</select>
						</div>
						<div class="clear-5"></div>	
					</div>
					

					<div id="vote-selector" class="form-group hide selector">
						<label class="col-sm-2 control-label">投票</label>
						<div class="col-sm-8">
							<select id="vote-id" name="v">
							<?
							foreach ($vote_list as $vote)
							{
							?>
								<option value="<?= $vote['id'] ?>"><?= $vote['name'] ?></option>
							<?
							}
							?>
							</select>
						</div>
						<div class="clear-5"></div>	
					</div>
					

					<div id="post-selector" class="form-group hide selector">
						<label class="col-sm-2 control-label">文章</label>
						<div class="col-sm-8">
							<select id="post-id" name="p">
							<?
							foreach ($post_list as $post)
							{
							?>
								<option value="<?= $post['id'] ?>"><?= $post['name'] ?></option>
							<?
							}
							?>
							</select>
						</div>
						<div class="clear-5"></div>	
					</div>
																								

					<div class="form-group">
						<label class="col-sm-2 control-label">子模块时间</label>
						<div class="col-sm-6 input-group" >
							<input type="text" id="child-module-time" class="form-control">
							<span class="input-group-addon">分钟</span>
						</div>
					</div>	
					<div class="clear-5"></div>				
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="saveChildModule()">保存</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/admin/agenda-edit.js"></script> 
