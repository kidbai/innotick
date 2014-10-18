function save (post_id_list) {
    console.log(post_id_list);
    var post_list = [];
    if(!$("#post").val())
    {
        alert("请查看是否没有填写信息");
        $("#post").focus();
        return;
    }
    post_list = $("#post").val().split('-');
    for(var post in post_list)
    {
        console.log(post);
        var post_exist = $.inArray(parseInt(post_list[post]), post_id_list);
        console.log(post_exist);
        if(post_exist == -1)
        {
            alert('这个ID:' + post_list[post] + '不存在或是否格式错误');
            return;
        }
    }
    var post = {};
    var data = {};
    data['post'] = post_list;
    console.log(data);
    data = JSON.stringify(data);
    $.ajax({
        url: '/admin/content-view-post-save',
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