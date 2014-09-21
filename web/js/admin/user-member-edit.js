function save()
{
    var keyMap = {
        host: '#host',
        member: '#member',
        assistant: '#assistant',
        commentator: '#commentator',
        recorder: '#recorder',
    };

    var data = {};
    data.id = meeting_id;
    for (var key in keyMap)
    {
        var selector = keyMap[key];
        data[key] = $(selector).val();
        if (!data[key])
        {
            alert('请填写完整');
            $(selector).focus();
            return;
        }
    }

    $.ajax({
        url: '/admin/meeting-member-edit-save',
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function(data)
        {
            if (data.code == 0)
            {
                window.location.href = '/admin/meeting';
            }
            else
            {
                alert('保存失败');
            }
        }
    })
}