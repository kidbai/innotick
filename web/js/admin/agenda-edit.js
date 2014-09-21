function addModule()
{
	$('#module-id').val(0);
	$('#module-name').val('');
	$('#module-type').val(1);
	$('#module-time').val('');

	$('#moduleModal').modal('show');
}

function editModule(id)
{
	$('#module-id').val(id);

	var name = $('#module-' + id + ' ').attr('data-name');
	var type = $('#module-' + id + ' ').attr('data-type');
	var time = $('#module-' + id + ' ').attr('data-time');

	$('#module-name').val(name);
	$('#module-type').val(type);
	$('#module-time').val(time);

	$('#moduleModal').modal('show');
}

function saveModule()
{
	var id = $('#module-id').val();
	var name = $('#module-name').val();
	var type = $('#module-type').val();
	var time = $('#module-time').val();

	if (!name)
	{
		alert('请填写模块名');
		return;
	}
	if (!time)
	{
		alert('请填写模块时间');
		return;
	}

	if (parseInt(id) == 0)
	{
		var maxId = 0;
		$.each($('.module'), function(i, n){
			var moduleId = parseInt($(n).attr('data-id'));
			if (moduleId > maxId)
			{
				maxId = moduleId;
			}
		});
		maxId += 1;
		$.ajax({
			url: '/admin/agenda-module-render',
			type: 'POST',
			data: { 
				id: maxId,  
				name: name,
				type: type,
				time: time
			},
			success: function(data)
			{
				$('#module-holder').append(data);
				$('#moduleModal').modal('hide');
			}
		});

		return;
	}

	$('#module-' + id + ' ').attr('data-name', name);
	$('#module-' + id + ' ').attr('data-type', type);
	$('#module-' + id + ' ').attr('data-time', time);

	$('#module-' + id + ' .name').text(name);
	$('#module-' + id + ' .type').text(type_map[type]);
	$('#module-' + id + ' .time').text(time);

	$('#moduleModal').modal('hide');
}

function removeModule(id)
{
	var name = $('#module-' + id + ' ').attr('data-name');
	if (!confirm('确认删除模块' + name + '?')) return;

	$('#module-' + id).remove();
}

function addChildModule(id)
{
	$('#parent-module-id').val(id);
	$('#child-module-id').val(0);
	$('#child-module-name').val('');
	$('#child-module-type').val(1);
	$('#child-module-time').val('');	
	childModuleTypeChanged();
	$('#childModuleModal').modal('show');
}

function editChildModule(id, childId)
{
	var mainKey = '#module-' + id + '-' + childId;

	$('#parent-module-id').val(id);
	$('#child-module-id').val(childId);

	var name = $(mainKey).attr('data-name');
	var type = $(mainKey).attr('data-type');
	var time = $(mainKey).attr('data-time');
	var pid = $(mainKey).attr('data-pid');

	$('#child-module-name').val(name);
	$('#child-module-type').val(type);
	$('#child-module-time').val(time);

	type = parseInt(type);
	var types = ['#questionnaire-selector', '#vote-selector', '#post-selector'];
	$(types[type - 1]).val(pid);

	childModuleTypeChanged();

	$('#childModuleModal').modal('show');
}

function saveChildModule()
{
	var id = $('#parent-module-id').val();
	var childId = $('#child-module-id').val();
	var mainKey = '#module-' + id + '-' + childId;

	var name = $('#child-module-name').val();
	var time = $('#child-module-time').val();
	if (!name)
	{
		alert('请填写模块名');
		return;
	}
	if (!time)
	{
		alert('请填写模块时间');
		return;
	}

	var type = $('#child-module-type').val();
	type = parseInt(type);
	var types = ['#questionnaire-id', '#vote-id', '#post-id'];
	var pid = $(types[type - 1]).val();
	// console.log(mainKey, types[type - 1], pid);

	if (parseInt(childId) == 0)
	{
		var maxId = 0;
		$.each($('#module-' + id + ' .child-holder .child'), function(i, n){
			var moduleId = parseInt($(n).attr('data-id'));
			if (moduleId > maxId)
			{
				maxId = moduleId;
			}
		});
		maxId += 1;		
		$.ajax({
			url: '/admin/agenda-child-module-render',
			type: 'POST',
			data: { 
				parent_id: id,
				id: maxId,  
				name: name,
				type: type,
				pid: pid,
				time: time
			},
			success: function(data)
			{
				$('#module-' + id + ' .child-holder').append(data);
				$('#childModuleModal').modal('hide');
			}
		});

		return;
	}

	

	$(mainKey).attr('data-name', name);
	$(mainKey).attr('data-type', type);
	$(mainKey).attr('data-time', time);
	$(mainKey).attr('data-pid', pid);

	$(mainKey + ' .child-name').text(name);
	$(mainKey + ' .child-type').text(child_type_map[type]);
	$(mainKey + ' .child-time').text(time);

	$('#childModuleModal').modal('hide');
}

function childModuleTypeChanged()
{
	var type = parseInt($('#child-module-type').val());

	$('.selector').removeClass('hide');
	$('.selector').addClass('hide');

	var types = ['#questionnaire-selector', '#vote-selector', '#post-selector'];
	$(types[type - 1]).removeClass('hide');
}

function removeChildModule(id, childId)
{
	var mainKey = '#module-' + id + '-' + childId;
	var name = $(mainKey).attr('data-name');
	if (!confirm('确认删除模块' + name + '?')) return;

	$(mainKey).remove();
}

function save()
{
	var config = [];
	$.each($('#module-holder .module'), function(i, n){
		var module = {};
		module.id = $(n).attr('data-id');
		module.name = $(n).attr('data-name');
		module.type = $(n).attr('data-type');
		module.time = $(n).attr('data-time');

		var child = [];
		$.each($(n).find('.child-holder .child'), function(i, cn){
			var c = {};
			c.id = $(cn).attr('data-id');
			c.type = $(cn).attr('data-type');
			c.pid = $(cn).attr('data-pid');
			c.name = $(cn).attr('data-name');
			c.time = $(cn).attr('data-time');
			child.push(c);
		})
		module.child = child;

		config.push(module);
	})

	var name = $('#agenda-name').val();
	if (!name)
	{
		alert('请填写议程配置名');
	}

	$.ajax({
		url: '/admin/agenda-save',
		type: 'POST',
		data: {
			id: agenda_id,
			name: name,
			data: JSON.stringify(config)
		},
		dataType: 'json',
		success: function(data)
		{
			if (data.code == 0)
			{
				alert('保存成功');
				//window.location.href = '/admin/agenda-edit?id=' + data.id;
				window.location.href = '/admin/agenda-list';
			}
			else
			{
				alert('保存失败');
			}
		}
	});

}

$(function(){
	$('#module-holder').sortable({axis: 'y'});
	$('#module-holder .child-holder').sortable({axis: 'y'});

});











