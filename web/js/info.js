
$("#info .column .info .menu li").mouseover(function(){
    $("#info .column .info .menu li .list").removeClass("active_2");
    $("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
    $(this).children(".color-line").addClass("bg-orange-2");
    $(this).children(".list").addClass("active_2");
}).mouseout(function(){
    $("#info .column .info .menu li .color-line").removeClass("bg-orange-2");
    $("#info .column .info .menu li .list").removeClass("active_2");
});

$("#img-upload").click(function(){
    var img_src = $("#img-upload").val();
    // $("#info .avatar .circle img").attr("src");
});

function saveinfo()
{
    var email = $("#email_addr").val();
    var avatar = $("#user-avatar").val(); //头像
    var name = $("#user-name").val();
    var phone = $("#user-phone").val();
    var gender_val = $('input[type=radio][name=gender]:checked').val();
    var desc = $("#desc-info").val();
    var url = $("#url-addr").val();
    var province = $("#address-province").val();
    var city = $("#address-city").val();
    var county = $("#address-county").val(); 
    var data = { "email":email, "avatar":avatar, "gender":gender_val, "phone": phone, "name":name, "province":province, "city":city, "county":county, "desc":desc, "url":url};
    var prop_null = false;
    var prop_name = '';
    for(var prop in data)
    {
        // console.log(data[prop]);
        if(data[prop] == '')
        {
            if(prop == 'province' || prop == 'city' || prop == "county")
            {
                console.log("province city county");
                $("#error-county").show();
                prop_null = true;
                prop_name = "county";
            }
            else
            {
                $("#error-" + prop).show();
                prop_null = true;
                prop_name = prop;
                console.log(prop_name + "空值");
            }
            
        }
        else
        {
            $("#error-" + prop).hide();
        }
    }
    
    if(prop_null)
    {
        var height = $("#error-" + prop_name).offset().top - 200;
        $('html, body').animate({
            scrollTop : height 
        });
        // $("#error-" + prop_name).focus();
        // console.log("focus");
        return false;
    }

    $.ajax({
        url: '/user/user-save',
        type: 'POST',
        dataType: 'json',
        data:{ data:data, ';_csrf': global.csrfToken },
        success:function(data)
        {
            console.log("success"); 
            console.log(data);
            alert("保存成功");
            window.location.reload(false);
        }
    });
}

$(function(){
    $(".setting input").change(function(){
        $(this).siblings(".can-not-null").hide();
    });
    $(".setting select").change(function(){
        $(this).siblings(".can-not-null").hide();
    });
    $(".setting textarea").change(function(){
        $(this).siblings(".can-not-null").hide();
    });

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
        $('#user-avatar').val(file.name);
        avatar = file.name;
        $('#file-upload-img').attr('src', file.url);
    }).on('fileuploadfail', function (e, data) {
        $('#file-upload-status').text('文件上传失败');

    });
});
