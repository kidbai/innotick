$(function(){
    $('#question-holder').sortable({axis: 'y'});
    $('#question-holder .option-holder').sortable({axis: 'y'});

});

function addQuestion()
{
    var questionHtml = '<li class="question">' +
                            '<div class="name">' +
                                '<input type="text" class="name form-control" value="" placeholder="题名" />' +
                                '<div class="action-holder">' +
                                    '<a class="action fs-20" title="添加选项" href="javascript:;" onclick="addOption(this)"><i class="fa fa-plus-square"></i></a>' +
                                    '<a class="action fs-20 ml-10" title="删除本题" href="javascript:;" onclick="removeQuestion(this)"><i class="fa fa-remove"></i></a> ' +
                                '</div>' +
                            '</div>' +
                            '<ul class="option-holder">' +
                            '</ul>' +
                        '</li>';

    $('#question-holder').append(questionHtml);
}

function removeQuestion(n)
{
    if (!confirm('确定删除本题?')) return;

    $(n).parent().parent().parent().remove();
}

function addOption(n)
{
    var optionHtml = '<li class="option">' +
                            '<input type="text" class="option form-control" placeholder="选项内容"  />' +
                            '<div class="action-holder">' +
                                '<a class="action fs-20" title="删除选项" href="javascript:;" onclick="removeOption(this)"><i class="fa fa-remove"></i></a>' +
                            '</div>' +
                        '</li>';

    $(n).parent().parent().parent().find('.option-holder').append(optionHtml);
}

function removeOption(n)
{
    if (!confirm('确定删除本选项?')) return;

    $(n).parent().parent().remove();
}

function save()
{
    var name = $('#questionnaire-name').val();
    if (!name)
    {
        alert('请填写问卷名');
        $('#questionnaire-name').focus();
        return;
    }

    var config = [];
    var ok = true;
    $.each($('#question-holder .question'), function(i, n){
        var question = {};

        question.name = $(n).find('input.name').val();
        if (!question.name)
        {
            alert('请填写题目名');
            $(n).find('input.name').focus();
            ok = false;
            return;
        }

        var child = [];
        $.each($(n).find('input.option'), function(i, cn){
            var c = {};
            c.id = i + 1;
            c.content = $(cn).val();
            if (!c.content)
            {
                alert('请填写选项内容');
                $(cn).focus();
                ok = false;
                return;
            }
            child.push(c);
        })
        question.child = child;

        config.push(question);
    });

    if (!ok) return;

    $.ajax({
        url: '/admin/questionnaire-save',
        type: 'POST',
        data: {
            id: questionnaire_id,
            name: name,
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

