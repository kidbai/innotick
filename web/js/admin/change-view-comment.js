function save (comment_id_list) {
    var data = {};
    
    var keyMapPost = { comment1: 'comment1', comment2: 'comment2', comment3: 'comment3', comment4: 'comment4', comment5 : 'comment5'};
    var comment = {};
    var comment_id_exist = true;
    for (var key in keyMapPost)
    {
        var value = $('#' + keyMapPost[key]).val();
        if (!value)
        {
            alert('请填写完整');
            $('#' + keyMapPost[key]).focus();
            return;
        }
        // console.log($.inArray(parseInt(value), comment_id_list));
        if($.inArray(parseInt(value), comment_id_list) == -1)
        {
            comment_id_exist = false;
            alert("这个ID:" + value + "不存在");
            return;
        }
        comment[key] = value;
    }
    data['comment'] = comment;
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