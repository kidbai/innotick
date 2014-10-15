function save (post_id_list) {
    var post1 = parseInt($("#post1").val());
    var post2 = parseInt($("#post2").val()); 
    post1_exist = $.inArray(post1, post_id_list);
    post2_exist = $.inArray(post2, post_id_list);
    if(post1_exist != -1 && post2_exist != -1)
    {
        console.log("cunzai"); 
        var post = {};
        var data = {};
        post['post1'] = post1;
        post['post2'] = post2;
        data['post'] = post;
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
    else
    {
        alert("不存在这个ID");
        return false;
    }

    
    
            
}