var flag = true;
function createLoginInfo(icon){
    // console.log("createLoginInfo");
    // var icon_add = document.createElement("div");
    // $(icon_add).addClass("login"); // bg-login-green
    var icon_add = '<div class="login" id="login">'+
    					'<div class="text pt-12 pb-10 ml-60">'+
    						'<p class="fs-13 lp-1 sw"></p>'+
    					'</div>'+
    					'<div class="login_btn">'+
    						'<div class="lgbtn fl ml-60">'+
    							'<p class="fs-14">微博登陆</p>'+
    						'</div>'+
    						'<div class="text_or fl ml-14 mr-14">'+
    							'<p class="fs-14">或</p>'+
    						'</div>'+
    						'<div class="lgbtn fl">'+
    							'<p class="fs-14">QQ登陆</p>'+
    							'</div>'+
    						'</div>'
    				'</div>';
    icon.parent().parent().after(icon_add);
    //添加提示信息
    
  
}


function createDelInfo(del_sign){
	var del = "<div class='del-info'>" +
				"<div class='left_text'>很好，您将不会看到这篇文章了</div>"+
				"<div class='right_text'>撤回</div>"+
				"<div class='mid_text'>误删除可以马上</div>"+
			  "</div>";
	$(del_sign).parent().parent().after(del);
}

	$(function(){
		//nav事件
		$("#content .content-up .nav li").mouseover(function(){
			if($("#content .content-up .nav li").hasClass("active"))
			{
				$("#content .content-up .nav li").removeClass("active");
				$("#content .content-up .nav li .line").remove();
				$(this).addClass("active");
				var line = '<div class="line"></div>';
				$(this).prepend(line);
			}
			// $("#content .content-up .nav li:eq(0)").removeClass("active");
			// $("#content .content-up .nav li .line").
		}).mouseout(function(){
		});


        // post滑过效果 <span class="orange">#移动互联网&nbsp;#电子商务&nbsp;#融资</span>
        var label = '<div class="keyword"><div class="keyword-1 fl ml-8 orange">#移动互联网</div><div class="keyword-2 fl ml-8 orange">#电子商务</div><div class="keyword-3 fl ml-8 orange">#融资</div></div>';
        $(".post-label").after(label);

        //TAG 事件
       	$(".post .tag-like").mouseenter(function(){
       		if($(this).hasClass("on"))
       		{
				$(this).parent().siblings(".tag-label").children(".tag-label-like-recall").show();
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
       		if(flag)
			{
				createLoginInfo($(this));
       			$(".login").children(".text").children("p").text("登陆账号，保存此文章后稍后阅读");
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
       			$(".login").children(".text").children("p").text("登陆账号，我们将为您提供更多文章");
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

      //  		if($(this).hasClass("active"))
   			// {

   			// 	$(this).removeClass("active");
   			// }
   			// else
   			// {
   			// 	$(this).addClass("active");
   			// }
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
       			$(".login").children(".text").children("p").text("登陆账号，我们将减少为您提供这类文章");
	       		$(".login").addClass("bg-login-blue").slideDown("fast");
			}
			flag = false;
			// $(this).parent().parent().slideUp("fast", function(){
			// 	$(this).remove();
			// 	$(".login").remove();
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
       				console.log($(this).prev());
       				$(this).prev().remove();
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
       		setTimeout('$(".login").slideUp("fast", function(){$(this).prev().remove(); $(this).remove();flag=true})', 3000);
       		// setTimeout('$(".del-info").slideUp("fast", function(){$(this).remove()})', 3000);
       	});

       	//login
       	// $("#content").children(".content-down").children(".col-11").children(".login");
       	//评论 周鸿祎
       $("#content .from .from-text a").mouseover(function(){
       		$(this).addClass("orange").removeClass("lightgray");
       }).mouseout(function(){
       		$(this).removeClass("orange").addClass("lightgray");
       });

       	//post样式
        $(".post").mouseenter(function(){
        	$(this).children(".tag-list").show();
            $(this).addClass("bg-click");
            $(this).children(".text").children(".keyword").show();
        }),$(".post").mouseleave(function(){
        	$(this).children(".tag-list").hide();
            $(this).removeClass("bg-click");
            $(this).children(".text").children(".keyword").hide();
        });
    });
