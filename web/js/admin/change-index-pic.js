
$(function(){
    console.log("change");
    $('#picture-holder').sortable({axis: 'y'});

    var statusSelector = '#file-upload-status';
    var uploadSelector = '#file-upload';
    var hotSelector = '#picture';
    var hotImgSelector = '#pic';

    $(uploadSelector).fileupload({
        url: '/res/img-upload',
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        formData: { _csrf: global.csrfToken }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $(statusSelector).text('文件上传中... ' + progress + '%');
    }).on('fileuploaddone', function (e, data) {
        var file = data.result.file[0];
        $(statusSelector).text('文件上传成功');
        $(hotImgSelector).val(file.name);
        console.log(file.url+ "url========");
        $('#picture-holder .picture .panel-body img').attr('src', file.url);
    }).on('fileuploadfail', function (e, data) {
        $(statusSelector).text('文件上传失败');
    });         
});


function deleteHot(id)
{
    if (!confirm('确认删除？')) return;

    $('#hot-' + id).remove();
}

function save()
{
    var data = [];
    var pic = {};
    pic['img'] = $('#pic').val();
    pic['url'] = $('#pic-url').val();
    data.push(pic);
    console.log(data);
    // data = JSON.stringify(data);
    data = JSON.stringify(data);
    console.log(data);

    $.ajax({
        url: '/admin/content-index-big-pic-save',
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

