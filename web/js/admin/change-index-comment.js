function save (comment_id_list) {
    var comment1 = parseInt($("#comment1").val());
    var comment2 = parseInt($("#comment2").val()); 
    var comment3 = parseInt($("#comment3").val()); 
    comment1_exist = $.inArray(comment1, comment_id_list);
    comment2_exist = $.inArray(comment2, comment_id_list);
    comment3_exist = $.inArray(comment3, comment_id_list);
    // console.log($.inArray(comment1, comment_id_list));
    if( comment1_exist != -1 && comment2_exist != -1 && comment3_exist != -1)
    {
        var comment = {};
        var data = {};
        comment['comment1'] = comment1;
        comment['comment2'] = comment2;
        comment['comment3'] = comment3;
        data['comment'] = comment;
        console.log(data);
        data = JSON.stringify(data);
        $.ajax({
            url: '/admin/content-index-comment-save',
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
        alert("请检查ID是否存在");
    } 
            
}