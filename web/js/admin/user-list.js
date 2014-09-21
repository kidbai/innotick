function deletePost(id)
{
    if (!confirm('确认删除用户：'+ $('#user-'+ id +' .name').text() +'?')) return;

    $.ajax({
        url: '/admin/user-delete',
        type: 'POST',
        dataType: 'json',
        data: { id: id },
        success: function(data)
        {
            if (data.error == 0)
            {
                alert('删除成功');
                window.location.reload();
            }
            else
            {
                alert('删除失败，请稍后再试');
            }
        }
    });
}