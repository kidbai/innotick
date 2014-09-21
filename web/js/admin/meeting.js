$(function(){
    setInterval(function(){
        var last_process_id = $('#process-holder .process').first().attr('data-id');
        if (!last_process_id)
        {
            last_process_id = 0;
        }

        $.ajax({
            url: '/admin/meeting-process-list?id=' + meeting_id + '&last_process_id=' + last_process_id,
            success: function(data)
            {
                $('#process-holder').prepend(data);
            }
        });
    }, 500);
});

function endMeeting()
{
    if (!confirm('确定结束当前会议？')) return;

    $.ajax({
        url: '/admin/meeting-end',
        type: 'POST',
        data: { id: meeting_id },
        success: function(data)
        {
            if (data.code == 0)
            {
                window.location.href = '/admin/meeting';
            }
            else
            {
                alert('操作失败');
            }
        }
    });
}

function openSendMsg(id)
{
    $('#msg').val('');
    $('#user-id').val(id);
    $('#msgModal').modal('show');
}

function sendMsg()
{
    var msg = $('#msg').val();
    if (!msg)
    {
        alert('消息内容不能为空');
        return;
    }

    var user_id = $('#user-id').val();

    $.ajax({
        url: '/admin/meeting-send-msg',
        type: 'POST',
        data: { id: meeting_id, user_id: user_id, msg: msg },
        success: function(data)
        {
            if (data.code == 0)
            {
                $('#msgModal').modal('hide');
                alert('发送成功');
            }
            else
            {
                alert('发送失败');
            }
        }
    });

}




