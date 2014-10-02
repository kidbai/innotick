function deletePost(id)
{
    if (!confirm('确认删除：'+ $('#post-'+ id +' .title').text() +'?')) return;

    $.ajax({
        url: '/admin/post-delete',
        type: 'POST',
        dataType: 'json',
        data: { id: id, '_csrf': global.csrfToken },
        success: function(data)
        {
            if (data.code == 0)
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