$(function(){
    var avatar = '';  
	$('#file-upload').fileupload({
        url: '/res/img-upload',
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        formData: { _csrf: global.csrfToken }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#file-upload-status').text('文件上传中... ' + progress + '%');
    }).on('fileuploaddone', function (e, data) {
    	var file = data.result.file[0];
        $('#file-upload-status').text('文件上传成功');
        $('#student-avatar').val(file.name);
        console.log($('#student-avatar').val(file.name));
        console.log(file.name);
        avatar = file.name;
        $('#file-upload-img').attr('src', file.url);
    }).on('fileuploadfail', function (e, data) {
        $('#file-upload-status').text('文件上传失败');
        
    });	
    console.log(avatar);
    
});