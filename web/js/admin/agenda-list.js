function deleteAgenda(id)
{
	if (!confirm('确认删除议程配置：' + $('#agenda-'+ id +'-name').text() + '?')) return;

	$.ajax({
		url: '/admin/agenda-delete',
		type: 'POST',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(data)
		{
			if (data.code == 0)
			{
				alert('删除成功');
				//window.location.href = '/admin/agenda-edit?id=' + data.id;
				window.location.reload();
			}
			else
			{
				alert('删除失败');
			}
		}
	});	
}