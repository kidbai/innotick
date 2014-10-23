
$(function(){

    $('#picture-holder').sortable({axis: 'y'});

    $.each($(".panel-body"), function(i, n){
        var count = $(n).attr("id");
        var statusSelector = '#file-upload-status-' + count;
        var uploadSelector = '#file-upload-' + count;
        var imgSelector = '#special-column-img-' + count;
        var urlSelector = '#pic-' + count;
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
            $(imgSelector).val(file.name);
            $(urlSelector).attr('src', file.url);
        }).on('fileuploadfail', function (e, data) {
            $(statusSelector).text('文件上传失败');
        });         
    });
    

});

function del(id)
{
    if (!confirm('确认删除？')) return;

    $('#' + id).remove();
}

function save(key)
{
    var null_value = false;
    console.log(key);
    var data = [];
    $.each($('.panel-body'), function(i, n){ 
        var count = $(n).attr('id');
        var special = {};
        console.log(count);
        special['img'] = $('#special-column-img-' + count).val();
        console.log(special['img']);
        special['post_id'] = $('#special-post-' + count).val();
        console.log(!special['post_id']);
        console.log(!special['img']);
        if(!special['post_id'] || !special['img'])
        {
            alert("请填写完整");
            null_value = true;
            return false;
        }
        data.push(special);
        console.log(data);
    });
    if(null_value)
    {
        null_value = false;
        return;
    }
    data = JSON.stringify(data);
    setConfig(key, data);

}

var html = 
            '<div class="panel-body" id="{id}">' + 
                '<img id="pic-{id}" class="bg" width="180" height="90" src="">' +
                '<input type="hidden" id="special-column-img-{id}" value="" />' +
                '<input type="text" id="special-post-{id}" placeholder="文章ID" value="" class="form-control title">' +
                '<div class="clear-20"></div>' +
                '<div class="action">' +
                    '<div class="fl">' +
                        '<span class="btn btn-success fl file-upload-btn" >' +
                            '上传<input type="file" id="file-upload-{id}" name="file" />' +
                        '</span>' +
                        '<span class="fl file-upload-status" id="file-upload-status-{id}"></span>' +
                    '</div>' +
                    '<a class="btn btn-danger fr" href="javascript:;" onclick="" >删除</a>' +
                '</div>' +
            '</div>' ;
            

function add()
{
    special_count++;
    console.log(special_count);
    var hotHtml = '' + html;
    hotHtml = hotHtml.replaceAll('{id}', special_count);
    console.log(hotHtml);
    $('#picture-holder').append(hotHtml);

    var statusSelector = '#file-upload-status-' + special_count;
    var uploadSelector = '#file-upload-' + special_count;
    var imgSelector = '#special-column-img-' + special_count;
    var urlSelector = '#pic-' + special_count;


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
        $(imgSelector).val(file.name);
        $(urlSelector).attr('src', file.url);
    }).on('fileuploadfail', function (e, data) {
        $(statusSelector).text('文件上传失败');
    }); 
}

