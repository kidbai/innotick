//点赞
function like(post_id)
{
    console.log("lik");
    $.ajax({
        url: '/post/action-save',
        type: 'POST',
        dataType: 'json',
        data: { post_id: post_id, type: 1, '_csrf': global.csrfToken },
        success: function(data)
        {
            console.log("success");
            console.log(data);
            console.log(data.count);
            $("#content .icon-like").siblings("span").text("(" + data.count + ")");
        }
    });    
}

//不喜欢
function dislike(post_id)
{
    $.ajax({
        url: '/post/action-save',
        type: 'POST',
        dataType: 'json',
        data: { post_id: post_id, type: 2, '_csrf': global.csrfToken },
        success: function(data)
        {
            console.log("success");
            console.log(data);
            console.log(data.count);
            $("#content .icon-dislike").siblings("span").text("(" + data.count + ")");
        }
    });    
}

//提交评论
function submit_comment(post_id)
{
    console.log(post_id);
    console.log($("#comment_content").val());
    var comment_content = $("#comment_content").val();
    $.ajax({
        url: '/post/comment-add',
        type: 'POST',
        dataType: 'json',
        data: { post_id: post_id, content: comment_content, '_csrf': global.csrfToken },
        success: function(data)
        {
            console.log("success");
            console.log(data);
            console.log(data.content);
            console.log(data.post_id);
        }
    });
}

// //comment_like
// function comment_like(post_id)
// {

// }


$(function(){

    // console.log($("#content .main .icon .sbtn-orange").children().children());
    $("#content .main .icon .sbtn-orange").mouseover(function(){
        console.log("aaa");
        $(this).css({"backgroundColor":"#d44137"});
        $(this).children().children().removeClass("orange").addClass("wt");
    }).mouseout(function(){
        $(this).css({"backgroundColor":"#ffffff","color":"#d44137"});
        $(this).children().children().addClass("orange").removeClass("wt");
    });
    $("#content .main .icon .sbtn-grass").mouseover(function(){
        console.log("aaa");
        $(this).css({"backgroundColor":"#38ad5a"});
        $(this).children().children().removeClass("grass").addClass("wt");
    }).mouseout(function(){
        $(this).css({"backgroundColor":"#ffffff","color":"#38ad5a"});
        $(this).children().children().addClass("grass").removeClass("wt");
    });



    $("#content .main .icon .icon-list").click(function(){
        if($(this).hasClass("active"))
        {
            $(this).removeClass("active");
        }
        else
        {
            $(this).addClass("active");
        }
    });



    // //智能浮动
    // $.fn.smartFloat = function() {
    // var position = function(element) {
    //     var top = element.position().top, pos = element.css("position");
    //     console.log(element.position().top);
    //     $(window).scroll(function() {
    //         var scrolls = $(this).scrollTop();
    //         console.log(scrolls);
    //         if (scrolls > top + 70) {
                
    //             if (window.XMLHttpRequest) {
    //                 element.css({
    //                     position: "fixed",
    //                     top: 0
    //                 });    
    //             } else {
    //                 element.css({
    //                     top: scrolls
    //                 });    
    //             }
    //         }else {
    //             element.css({
    //                 position: "absolute",
    //                 top: top
    //             });    
    //         }
    //     });
    // };
    // return $(this).each(function() {
    //     position($(this));                         
    // });
    // };

    // //绑定
    // // $(".qrcode_2").smartFloat();
        
});
