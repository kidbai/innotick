<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => '1-2']) ?>
        </div>

		<div class="col-md-10">
			<a class="btn btn-success" href="/admin/agenda-edit">添加配置</a>
			<div class="clear-20"></div>
			<table class="table table-condensed table-hover table-bordered data-table" style="width: 400px;">
				<thread>
				  <tr>
				  	<th class="tc">编辑</th>
				    <th class="tc">删除</th>
				    <th>配置名</th>
				  </tr>
				</thred>				
				<?
				foreach ($agenda_list as $agenda)
				{
					$edit_url = url(['/admin/agenda-edit', 'id' => $agenda->id]);
				?>
					<tr>
						<td class="tc"><a href="<?= $edit_url ?>">编辑</a></td>
						<td class="tc"><a href="javascript:;" onclick="deleteAgenda(<?= $agenda->id ?>)">删除</a></td>
						<td id="agenda-<?= $agenda->id ?>-name"><?= $agenda->name ?></td>
					</tr>
				<?
				}
				?>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript" src="/js/admin/agenda-list.js"></script> 