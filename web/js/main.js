function login()
{
    var username = $('#login-username').val();
    var password = $('#login-password').val();

    $.ajax({
        url: '/user/login-ajax',
        type: 'POST',
        dataType: 'json',
        data: { username: username, password: password, '_csrf': global.csrfToken },
        success: function(data)
        {
            if (data.code == 0)
            {
                window.location.reload();
            }
            else
            {
                alert('用户名或密码错误');
            }
        }
    });
}

function get_scroll_top()
{
    var scrollTop = 0;
    if(document.documentElement && document.documentElement.scrollTop)
    {
        scrollTop = document.documentElement.scrollTop;
    }
    else if(document.body)
    {
        scrollTop = document.body.scrollTop;
    }
    return scrollTop;
}

function get_client_height()
{
    var clientHeight = 0;
    if(document.body.clientHeight && document.documentElement.clientHeight)
    {
        var clientHeight = (document.body.clientHeight < document.documentElement.clientHeight) ? document.body.clientHeight : document.documentElement.clientHeight;        
    }
    else
    {
        var clientHeight = (document.body.clientHeight > document.documentElement.clientHeight) ? document.body.clientHeight : document.documentElement.clientHeight;    
    }
    return clientHeight;
}

function get_scroll_height()
{
    return Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
}








$(function(){
    $("#top .nav .menu li .nav-item-list").mouseover(function(){
       // $("#top .nav .menu li img").prop("src","/img/icon/dropdown-light.png");
       $(this).children("img").prop("src","/img/icon/dropdown-light.png");
    }).mouseout(function(){
       $(this).children("img").prop("src","/img/icon/dropdown.png");
    });

    $(".user").mouseenter(function(e){
            $(".user").addClass("bg-orange");
            $(".user .username").removeClass("orange").addClass("sw");
            $(".user .info .down").addClass("on");
            $(".user .info .up").addClass("on");
            $(".item").show();
    }),$(".user").mouseleave(function(e){
        if(e.offsetX < 0 || e.offsetX > 200 || e.offsetY < 0){
            $(".user").removeClass("bg-orange");
            $(".user .username").addClass("orange").removeClass("sw");
            $(".user .info .down").removeClass("on");
            $(".user .info .up").removeClass("on");
            $(".item").hide();
        }
    });
    
    $(".item").mouseleave(function(e){
        console.log(e);
        if(e.offsetX < 0 || e.offsetX > 200 || e.offsetY > 36){
            $(".user").removeClass("bg-orange");
            $(".user .username").addClass("orange").removeClass("sw");
            $(".user .info .down").removeClass("on");
            $(".user .info .up").removeClass("on");
            $(".item").hide();
        }
    });
    $(".item li").each(function(){
        $(this).mouseover(function(){
            $(this).addClass("nav-active");
        });
        $(this).mouseout(function(){
            $(this).removeClass("nav-active");
        });
    });

    $("#top .carousel li").mouseover(function(){
        $(this).children("p").addClass("orange");
    }).mouseout(function(){
        $(this).children("p").removeClass("orange");
    });
    var product_show = false; 
    var special_show = false;
    $("#top .nav .menu li:eq(0) .nav-item").click(function(){
        if(special_show)
        {
            $("#top .carousel").slideUp("fast");
            $("#top .carousel .content-product").removeClass("on");
            special_show = false;
        }
        if(!$("#top .carousel .content-special").hasClass("on"))
        {
            product_show = true;
            $("#top .carousel").slideDown("fast").addClass("on");
            $("#top .carousel .content-special").addClass("on");
        }
        else
        {
           $("#top .carousel").slideUp("fast").removeClass("on");
           $("#top .carousel .content-special").removeClass("on");
        }
    });
    $("#top .nav .menu li:eq(2) .nav-item").click(function(){
        if(product_show)
        {
            $("#top .carousel").slideUp("fast");
            $("#top .carousel .content-special").removeClass("on");
            product_show = false;
        }
        if(!$("#top .carousel .content-product").hasClass("on"))
        {
            special_show = true;
            $("#top .carousel").slideDown("fast").addClass("on");
            $("#top .carousel .content-product").addClass("on");
        }
        else
        {
            $("#top .carousel").slideUp("fast").removeClass("on");
            $("#top .carousel .content-product").removeClass("on");
        }
    });
    

    // $("#top .carousel").mouseleave(function(e){
    //     console.log(e);
    //     if(e.offsetX < 0 || e.offsetX > 1200 || e.offsetY > 320 || e.offsetY < 0  )
    //     {
    //         $("#top .carousel .content-product").removeClass("on");
    //         $("#top .carousel .content-special").removeClass("on");
    //         $("#top .carousel").slideUp("fast");
    //     }
    // });

    //创建登陆窗口
    $("#top .nav .login-nav-right .btn").click(function(){
        if(!$("#lg-window").hasClass("on"))
        {
            $("#lg-window").addClass("on");
            $(".shade").show();
        }
    });
    //窗口遮罩
    $("#lg-window .login-title .close").click(function(){
        $("#lg-window .lg-window-signin").removeClass("on"); 
        $("#lg-window .lg-window-login").removeClass("on"); 
        $("#lg-window .fpassword").removeClass("on");
        if($("#lg-window").hasClass("on"))
        {
            $("#lg-window").removeClass("on");
            $("#lg-window .lg-window-signin").removeClass("on");
            $("#lg-window .fpassword").removeClass("on");
            $(".shade").hide();
        }
    });
    $(".shade").click(function(){
        $("#lg-window").removeClass("on");
        $("#lg-window .lg-window-login").removeClass("on");
        $("#lg-window .lg-window-signin").removeClass("on"); 
        $("#lg-window .fpassword").removeClass("on");
        $(".shade").hide();
    });   

    //注册
    $("#lg-window .bottom .sign-in").click(function(){
        $("#lg-window .window_1").addClass("on");
        $("#lg-window .window_2").addClass("on");
        $("#lg-window .login-title .title").text("注册");
    });
    //登陆
    $("#lg-window .signin-input .signin-bottom .sign-in").click(function(){
        $("#lg-window .window_1").removeClass("on");
        $("#lg-window .window_2").removeClass("on");
        $("#lg-window .login-title .title").text("登陆");
    });
    //忘记密码
    $("#lg-window .mid .forget-password").click(function(){
        $("#lg-window .lg-window-login").addClass("on");
        $("#lg-window .fpassword").addClass("on");
    });

    $("#lg-window .fpassword .back").click(function(){
        $("#lg-window .fpassword").removeClass("on");
        $("#lg-window .lg-window-login").removeClass("on");
    });

    // $("#lg-window .mid .login-btn").click(function(){
    //     $("#lg-window").removeClass("on");
    //     $(".shade").hide();
    //     $("#top .nav .login-nav-right").addClass("on"); 
    //     $("#top .nav .user").addClass("on");
    // });
    // $("#top .item .logout").click(function(){
    //     $("#top .nav .login-nav-right").removeClass("on"); 
    //     $("#top .nav .user").removeClass("on"); 
    // });

});
    

