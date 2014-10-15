function save () {
    var data = {};
    
    var keyMapPost = { tag1: 'tag1', tag2: 'tag2', tag3: 'tag3', tag4: 'tag4', tag5 : 'tag5', tag6 : 'tag6' };
    var tag = {};
    for (var key in keyMapPost)
    {
        var value = $('#' + keyMapPost[key]).val();
        if (!value)
        {
            alert('请填写完整');
            $('#' + keyMapPost[key]).focus();
            return;
        }
        tag[key] = value;
    }
    data['tag'] = tag;
    console.log(data);
    data = JSON.stringify(data);
    console.log(data);
    $.ajax({
        url: '/admin/content-index-tag-save',
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