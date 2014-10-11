function nextPage(page_num)
{
  var num = parseInt(page_num) + 1;
  console.log(parseInt(num));
  $("#content .loadnext").addClass("on");
  $("#content .load .spinner").addClass("on");

  window.location.href = '/?page=' + num;
}

// $(function(){
//   //智能浮动
//   $.fn.smartFloat = function() {
//     var position = function(element) {
//         var top = element.position().top, pos = element.css("position");
//         console.log(element.position().top);
//         $(window).scroll(function() {
//             var scrolls = $(this).scrollTop();
//             console.log(scrolls);
//             if (scrolls > top + 70) {
//                 if (window.XMLHttpRequest) {
//                     element.css({
//                         position: "fixed",
//                         top: 0,
//                     });    
//                 } else {
//                     element.css({
//                         top: scrolls
//                     });    
//                 }
//             }else {
//                 element.css({
//                     position: "absolute",
//                     top: top
//                 });    
//             }
//         });
//     };
//     return $(this).each(function() {
//         position($(this));                         
//     });
//   };
// });



//绑定
// $(".qrcode").smartFloat();

var flag = true;
function createLoginInfo(icon){
    var icon_add = '<div class="login" id="login">'+
              '<div class="text pt-12 pb-10 ml-60">'+
                '<p class="fs-13 lp-1 sw"></p>'+
              '</div>'+
              '<div class="login_btn">'+
                '<div class="lgbtn fl ml-60">'+
                  '<p class="fs-14">微博登录</p>'+
                '</div>'+
                '<div class="text_or fl ml-14 mr-14">'+
                  '<p class="fs-14">或</p>'+
                '</div>'+
                '<div class="lgbtn fl">'+
                  '<p class="fs-14">QQ登录</p>'+
                  '</div>'+
                '</div>'
            '</div>';
    icon.parent().parent().after(icon_add);
    //添加提示信息
}

var one_second = function()
{
  setTimeout(check, 1000);
}

function createDelInfo(del_sign){
  var del = "<div class='del-info'>" +
              "<div class='left_text'>很好，您将不会看到这篇文章了</div>"+
              "<div class='right_text'>撤回</div>"+
              "<div class='mid_text'>误删除可以马上</div>"+
           "</div>";
  $(del_sign).parent().parent().after(del);
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

var num = 0;
var maxnum = 2;
var loading_post = false;
function scrollHandler()
{
    if(get_scroll_height() - get_client_height() - 310 <= get_scroll_top() && num < maxnum)
    {
      console.log('in', loading_post, num);
      $(".spinner .load-animation").addClass("show");
      var last_post_id = $('.post').last().attr('data-id');
      if (!last_post_id)
      {
        last_post_id = 0;
      }
      if (loading_post) return;
      loading_post = true;

      $("#content .load .spinner").addClass("on");
      $.ajax({
        url: '/site/post-list',
        type: 'POST',
        data: { 'last_post_id': last_post_id },
        success: function(html)
        {
          //console.log(html);
          loading_post = false;
          $('#post-holder').append(html);
          
          $("#content .load .spinner").removeClass("on");
        }
      });
      // if(num == 1)
      // {
      //   $(".spinner > div").css({"-webkit-animation": "null"});      
      // }
      
      num++;
    }
}

$(window).scroll(scrollHandler);




$(function(){

  // console.log(<? app()->user->isGuest ?>);

  // 下拉加载
  var distance = 50; // 距离下边界长度 /px
  var height = 230; //插入元素高度
  var load_maxnum = 10; // 加载次数
  var load_cout = 0;
  var totalheight = 0;
  var main = $("#content .content-down .left .load-content");
  
  //nav事件
  $("#content .content-up .nav li").mouseover(function(){
    if(!$("#content .content-up .nav li").hasClass("active_2"))
    {
      $(this).addClass("active_2");
      $(this).children(".line").remove();
      $(this).addClass("active_2");
      var line = '<div class="line"></div>';
      $(this).prepend(line);
    }
    // $("#content .content-up .nav li:eq(0)").removeClass("active");
    // $("#content .content-up .nav li .line").
  }).mouseout(function(){
    $("#content .content-up .nav li").removeClass("active_2");
    $(this).children(".line").remove();
  });

  $("#content .content-up .nav li").click(function(){
    $("#content .content-up .nav li").removeClass("active");
    $("#content .content-up .nav li").children(".line").remove();
    $("#content .content-up .nav li").children(".line_2").remove();
    $(this).addClass("active")
    var line_2 = '<div class="line_2"></div>';
    $(this).prepend(line_2);
  });


  

  //TAG 事件
  $(".post .tag-like").mouseenter(function(){
    if($(this).hasClass("on"))
    {
      $(this).parent().siblings(".tag-label").children(".tag-label-like-recall").show();
      console.log("he");
    }
    else
    {
      $(this).parent().siblings(".tag-label").children(".tag-label-like").show();
    }
  }).mouseleave(function(){
      $(this).parent().siblings(".tag-label").children(".tag-label-like-recall").hide();
      $(this).parent().siblings(".tag-label").children(".tag-label-like").hide();
    });
  $(".post .tag-like").click(function(){
    if(flag)// 判断用户是否登录
    {
      createLoginInfo($(this));
        $(".login").children(".text").children("p").text("登录账号，保存此文章后稍后阅读");
        $(".login").addClass("bg-login-red").slideDown("fast");
    }
    flag = false;
    $("#content .lgbtn").mouseenter(function(){
      $(this).css({"backgroundColor": "#e86163"});
      }).mouseleave(function(){
      $(this).css({"backgroundColor": "#e23a3c"});
    });
    if($(this).hasClass("on"))
    {
      $(".login").slideUp("fast",function(){
        $(this).remove();
        flag = true;
      });
      $(this).removeClass("on");

    }
    else
    {
      $(this).addClass("on");

      //收藏文章
      var post_id = $(this).parent().parent().attr("data-id");
      $.ajax({
        url: '/user/collection-post',
        type: 'POST',
        datatype: 'json',
        data: { post_id: post_id, '_csrf': global.csrfToken },
        success:function (data)
        {
          alert("收藏成功");
        }
      });
    }
  });

  $(".post .tag-add-cont").mouseenter(function(){
  if($(this).hasClass("on"))
  {
    $(this).parent().siblings(".tag-label").children(".tag-label-more-recall").show();
  }
  else
  {
    $(this).parent().siblings(".tag-label").children(".tag-label-more").show(); 
  }

  }).mouseleave(function(){
  $(this).parent().siblings(".tag-label").children(".tag-label-more").hide();
  $(this).parent().siblings(".tag-label").children(".tag-label-more-recall").hide();
  //问题点
  });
  $(".post .tag-add-cont").click(function(){
  if(flag)
    {
    createLoginInfo($(this));
    $(".login").children(".text").children("p").text("登录账号，我们将为您提供更多文章");
    $(".login").addClass("bg-login-green").slideDown("fast");
  }
  flag = false;
  $("#content .lgbtn").mouseenter(function(){
    $(this).css({"backgroundColor": "#e23a3c"});
  }).mouseleave(function(){
  $(this).css({"backgroundColor": "#129592"}); //颜色
  });
  if($(this).hasClass("on"))
  {
    $(".login").slideUp("fast",function(){
      $(this).remove();
      flag = true;
    });
    $(this).removeClass("on");
  }
  else
  {
    $(this).addClass("on");
  }
  if($(this).children(".tag-add-cancel").hasClass("active"))
  {
    $(this).children(".tag-add-cancel").removeClass("active");
  }
  else
  {
    $(this).children(".tag-add-cancel").addClass("active");
  }

  });

  $(".post .tag-del-cont").mouseenter(function(){
  if($(this).hasClass("active"))
  {
    $(this).parent().siblings(".tag-label").children(".tag-label-del-recall").show();
  }
  else
  {
    $(this).parent().siblings(".tag-label").children(".tag-label-del").show();  
  }
  console.log("hhh");
  }).mouseleave(function(){
    $(this).parent().siblings(".tag-label").children(".tag-label-del").hide();
    $(this).parent().siblings(".tag-label").children(".tag-label-del-recall").hide();
    $(this).children(".tag-del-dark").removeClass("on");
  });
  $(".post .tag-del-cont").click(function(){
  if(flag)
  {
    createLoginInfo($(this));
    var del_btn = "<div class='lgbtn fr mr-30'><p class='fs-14'>确认删除</p></div>"
    $("#login .login_btn").append(del_btn);
    $(".login").children(".text").children("p").text("登录账号，我们将减少为您提供这类文章");
    $(".login").addClass("bg-login-blue").slideDown("fast");
  }
  flag = false;
    // $(this).parent().parent().slideUp("fast", function(){
    //  $(this).remove();
    //  $(".login").remove();
    // });

  $("#content .lgbtn").mouseenter(function(){
    $(this).css({"backgroundColor":"#7185be"});
  }).mouseleave(function(){
    $(this).css({"backgroundColor":"#4d67ae"}); //颜色
  });

    
  if($(this).hasClass("active"))
  {

    $(this).removeClass("active");
  }
  else
  {
    $(this).addClass("active");
  }
  $("#content .lgbtn:eq(2)").click(function(){
      createDelInfo($(this));
    $(".login").slideUp("fast",function(){
    $(this).prev().slideUp("fast", function(){
      $(this).remove();
    });
    $(this).slideUp("fast", function(){
        $(this).remove();
    });
  });
  setTimeout('$(".del-info").slideUp("fast", function(){ $(this).remove})',3000);
  // $("")
  flag = true;
  $("#content .del-info .right_text").click(function(){
    if(!$(this).hasClass("on"))
    {
      $(this).addClass("on"); 
    }
    else
    {
      $(this).removeClass("on");
    }
  });
          
  });
  if($(this).hasClass("on"))
  {
    $(".login").slideUp("fast",function(){
      $(this).remove();
      flag = true;
    });
    $(this).removeClass("on");
  }
  else
  {
    $(this).addClass("on");
  }
  setTimeout('$(".login").slideUp("fast", function(){$(this).prev().slideUp("fast",function(){$(this).remove()}); $(this).remove();flag=true})', 3000);
  // setTimeout('$(".del-info").slideUp("fast", function(){$(this).remove()})', 3000);
  });

  //login
  // $("#content").children(".content-down").children(".col-11").children(".login");
  //评论 
  $("#content .from .from-text a").mouseover(function(){
    $(this).addClass("orange").removeClass("lightgray");
  }).mouseout(function(){
    $(this).removeClass("orange").addClass("lightgray");
  });

    //post样式
  $("#post-holder").on("mouseenter", ".post",function(){
    $(this).children(".tag-list").show();
      $(this).addClass("bg-click");
      $(this).children(".text").children(".keyword").show();
  }),$("#post-holder").on("mouseleave", ".post", function(){
    $(this).children(".tag-list").hide();
      $(this).removeClass("bg-click");
      $(this).children(".text").children(".keyword").hide();
  });
});
// });
