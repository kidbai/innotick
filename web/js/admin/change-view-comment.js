function save (comment_id_list) {
    var comment_list = [];
    if(!$('#comment'))
    {
        alert("请查看是否没有填写信息");
        $("#comment").focus();
        return;
    }
    comment_list = $('#comment').val().split('-');
    console.log(comment_id_list);
    for(var id in comment_list)
    {
        var comment_exist = $.inArray(parseInt(comment_list[id]), comment_id_list);
        if(comment_exist == -1)
        {
            alert('这个ID' + comment_list[id] + '不存在或是否格式错误');
            return;
        }
    }
    var data = {};
    data['comment'] = comment_list;
    console.log(data);
    data = JSON.stringify(data);
    console.log(data);
  
    $.ajax({
        url: '/admin/content-view-comment-save',
        type: 'POST',
        dataType: 'json',
        data: { data: data, '_csrf': global.csrfToken },
        success: function(data)
        {
            console.log(data);
            if (data.error == 0)
            {
                alert('保存成功');
                // window.location.reload();
            }
            else
            {
                alert('保存失败，请稍后再试');
            }
        }
    });
    

    
    
            
}