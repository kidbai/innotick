var global = global ? global : {};


$(function(){
    // set user info
    $.ajax({
        url : '/admin/user-info',
        type : 'GET',
        dataType : 'json',
        success : function(data){
            global.admin = data;
            $('#username').text(data.username + " 管理员");
        }
    });


});

function changeAdminPassword()
{
    $('#global-admin-password-old').val('');
    $('#global-admin-password').val('');
    $('#global-admin-password-again').val('');

    $('#adminChangePasswordModal').modal('show');
}

function saveAdminPassword()
{
    var old_password = $('#global-admin-password-old').val();
    if (!old_password)
    {
        alert('请填写旧密码');
        $('#global-admin-password-old').focus();
        return;
    }

    var password = $('#global-admin-password').val();
    if (!password)
    {
        alert('请填写新密码');
        $('#global-admin-password').focus();
        return;
    }

    var password_again = $('#global-admin-password-again').val();
    if (!password_again)
    {
        alert('请再输入一次新密码');
        $('#global-admin-password-again').focus();
        return;
    }

    if (password != password_again)
    {
        alert('两次输入的密码不一致');
        $('#global-admin-password-again').focus();
        return;
    }

    $.ajax({
        'url': '/admin/change-password',
        type: 'POST',
        dataType: 'json',
        data: {
            password: password,
            old_password: old_password,
            '_csrf': global.csrfToken
        },
        success: function(data)
        {
            if (data.error == 0)
            {
                $('#adminChangePasswordModal').modal('hide');
            }

            alert(data.message);
        }
    });
}

function logout()
{
    $.ajax({
        url: "/admin/logout",
        type: "GET",
        async: false,
        success :function(data){
            if(data.success == true)
            {
                window.location.href = "./admin";
            }
            else
            {
                alert(data.message);
            }
        }
    });
}

function setConfig(key, value)
{
    // var value = $('#' + key).val();
    if (!value)
    {
        alert('请填写完整');
        // $('#' + key).focus();
        return;
    }

    $.ajax({
        url: '/admin/set-config',
        type: 'POST',
        dataType: 'json',
        data: { key: key, value: value, '_csrf': global.csrfToken },
        success: function(data)
        {
            if (data.code == 1)
            {
                alert('保存成功');
            }
            else
            {
                alert('未更新');
            }
        }
    });
}











function setActiveMenu(section, row)
{
    $('.nav-menu li').removeClass("active");
    $('#nav-menu-' + section + '-' + row).addClass("active");
}

function setActiveSection(section, row, dg)
{
    $('.section-holder').hide();
    $('#dg-holder').hide();

    if (dg)
    {
        $('#dg-holder').show();

        // $('.cond-group').hide();
        // $('#cond-group-' + section + '-' + row).show();
    }

    $('#section-' + section + '-' + row).show();

    setActiveMenu(section, row);
}
