$(function(){
    $('#question-holder').sortable({axis: 'y'});

});

function addQuestion()
{
    var questionHtml = '<li class="question well">' +
                            '<input type="text" class="user form-control" placeholder="用户ID" />' +
                            '<input type="text" class="name form-control" placeholder="议题名"  />' +
                            '<div class="action-holder">' +
                                '<a class="action fs-20" title="删除议题" href="javascript:;" onclick="removeQuestion(this)"><i class="fa fa-remove ml-10"></i></a>' +
                            '</div>' +
                        '</li>';

    $('#question-holder').append(questionHtml);
}

function removeQuestion(n)
{
    if (!confirm('确定删除本题?')) return;

    $(n).parent().parent().remove();
}


function save()
{
    var name = $('#vote-name').val();
    if (!name)
    {
        alert('请填写完整');
        $('#vote-name').focus();
        return;
    }

    var min_option = $('#vote-min').val();
    if (!name)
    {
        alert('请填写完整');
        $('#vote-min').focus();
        return;
    }

    var max_option = $('#vote-max').val();
    if (!name)
    {
        alert('请填写完整');
        $('#vote-max').focus();
        return;
    }        

    var config = [];
    var ok = true;
    $.each($('#question-holder .question'), function(i, n){
        var question = {};

        question.user = $(n).find('input.user').val();
        if (!question.user)
        {
            alert('请填写用户ID');
            $(n).find('input.user').focus();
            ok = false;
            return;
        }

        question.name = $(n).find('input.name').val();
        if (!question.name)
        {
            alert('请填写议题名');
            $(n).find('input.name').focus();
            ok = false;
            return;
        }

        config.push(question);
    });
    if (!ok) return;
  
    $.ajax({
        url: '/admin/vote-save',
        type: 'POST',
        data: {
            id: vote_id,
            name: name,
            min_option: min_option,
            max_option: max_option,
            data: JSON.stringify(config)
        },
        dataType: 'json',
        success: function(data)
        {
            if (data.code == 0)
            {
                alert('保存成功');
                //window.location.href = '/admin/agenda-edit?id=' + data.id;
                window.location.href = '/admin/questionnaire-list';
            }
            else
            {
                alert('保存失败');
            }
        }
    });
 
}

