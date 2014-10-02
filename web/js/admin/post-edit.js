KindEditor.ready(function(K) {
    window.editor = K.create('#post-content', {
        minHeight : 300,
        pasteType: 1,
        items: [
            'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'code', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
            'formatblock', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image', 'multiimage',
            'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
            'anchor', 'link', 'unlink'
        ]
    });

	if (window.editor)
	{
		setInterval(function(){
			window.editor.sync();
		}, 50);		
	}    
});

$(function(){
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
        $('#post-img').val(file.name);
        $('#file-upload-img').attr('src', file.url);
    }).on('fileuploadfail', function (e, data) {
        $('#file-upload-status').text('文件上传失败');
    });	
});