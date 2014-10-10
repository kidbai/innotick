<div id="content" class="wrapper">
    <div class="column content-down bg-click">
        <div class="article_content border-right-1">
            <div class="left col-11">
                <div class="post-title">
                    <div class="banner blur-5" style="background: url(/upload/img/<?= $post->img ?>); background-size: cover;"></div>
                    <div class="content"><?= $post->title ?></div>
                </div>
                <div class="main bg-wt">
                    <div class="article mt-20">
                        <?= $post->content ?>
                    </div>
                    <div class="icon border-bottom-1">
                        <ul class="ml-40 mt-70">
                            <li class="fl ml-25" onclick="like(<?= $post->id ?>)">
                                <div class="icon-list icon-like fl">
                                    <img class="off" src="/img/icon/like.png" width="25" height="30" alt=""/>
                                    <img class="on" src="/img/icon/like-light.png" width="25" height="30" alt="">
                                    <div class="clear"></div>
                                </div>
                                <span class="fs-15 ml-1 icon-like-num fl">(<?= $post->likeCount ?>)</span>
                            </li>
                            <li class="fl ml-25" onclick="dislike(<?= $post->id ?>)">
                                <div class="icon-list icon-dislike fl">
                                    <img class="off" src="/img/icon/dislike.png" width="25" height="30" alt=""/>
                                    <img class="on" src="/img/icon/dislike-light.png" width="25" height="30" alt="">
                                    <div class="clear"></div>
                                </div>
                                <span class="fs-15 ml-1 icon-dislike-num fl">(<?= $post->dislikeCount ?>)</span>
                            </li>
                            <!-- <li class="fl ml-25">
                                <div class="icon-list icon-share fl">
                                    <img class="off" src="/img/icon/share.png" width="25" height="23" alt=""/>
                                    <img class="on" src="/img/icon/share-light.png" width="25" height="23" alt="">
                                    <div class="clear"></div>
                                </div>
                                <span class="fs-15 ml-2 icon-share-num fl">(45)</span>
                            </li> -->
                            <li class="fl ml-25">
                                <div class="icon-list icon-collected fl">
                                    <img class="off" src="/img/icon/collected.png" width="30" height="23" alt=""/>
                                    <img class="on" src="/img/icon/collected-light.png" width="30" height="23" alt="">
                                    <div class="clear"></div>
                                </div>
                                <span class="fs-15 ml-4 icon-collected-num fl">(45)</span>
                            </li>

                            
                            <!-- <li class="sbtn-orange weixin ml-130 fl"><a href=""><p class="orange fs-15">分享到微信</p></a></li>
                            <li class="sbtn-grass weibo ml-20 fl"><a href=""><p class="grass fs-15">分享到微博</p></a></li> -->
                        </ul>
                    </div>
                    <div class="link border-bottom-1">
                        <img src="/img/icon/keyword.png" width="17" height="17" alt="" class="fl ml-60 mt-20"/>
                        <div class="fl fs-15"><div class="fs-14 fl ml-10">#</div><div class="fs-14 fl linkedin ml-10" href="#">LinkedIn</div><div class="fs-14 fl ml-10">#</div><div class="fs-14 fl lingying ml-10" href="">领英</div></div>
                    </div>
                    <!-- <div class="designer border-bottom-1">
                        <div class="circle ml-60 mt-20 fl bg-orange"></div>
                        <div class="description fl mt-26 ml-10">
                            <div class="fs-14 fl l-designer lp-1 bold pt-1">作者用户名</div>
                            <div class="wrap-designer fl bg-designer ml-10">
                                <div class="fl ml-10 wt fs-13">设计师</div>
                            </div>
                            <div class="clear"></div>
                            <p class="l-designer mt-5">人生路，真慌张。WeChat: zhangyuxin87</p>
                        </div>
                    </div> -->
                    <div class="comment-board border-bottom-1">
                        <div class="l-designer fs-13 ml-60 mt-20">文章评论(<?= $post->commentCount ?>)</div>
                        <textarea id="comment_content" class="fs-14 mt-15 ml-60 " cols="95" rows="5" placeholder="你怎么看?"></textarea>
                        <?
                        if (app()->user->isGuest)
                        {
                        ?>
                        <div class="fl l-designer ml-60 mt-15"><div class="fl fs-13 l-designer">登录</div><div class="discuss fl ml-5 gray-1">后参与讨论</div></div>
                        <?
                        }
                        ?>
                        <div class="fs-14 fr submit-btn" onclick="submit_comment(<?= $post->id ?>)">提交评论</div>
                    </div>
                    <div id="comment-holder" class="">
                    <?
                    echo $this->render('/post/comment', ['comment_list' => $comment_list]);
                    ?> 
                    </div>
                </div>
            </div>  
            <div class="right col-4">
                <div class="hot-list bg-wt article">
                    <div class="hot">
                        <div class="img-line-up"></div> 
                        <a href="#"><img src="#" alt=""/></a>   
                        <div class="fs-13 hot-text">PayPal联合创始人Peter Thie焦点哲学</div>
                    </div>
                    <div class="hot">
                        <div class="img-line-down"></div>   
                        <a href="#"><img src="#" alt=""/></a>   
                        <div class="fs-13 hot-text">PayPal联合创始人Peter Thie焦点哲学</div>
                    </div>
                    <!-- 屏幕header-->
                    <div class="header">
                        <p class="fs-13">优质评论</p>
                    </div>
                    <HR align=center width=86.66666667% color=#ee6350 SIZE=2 style="margin-left:20px;" noShade>
                    <div class="small-article ml-20">
                        <div class="bg-click fl mt-10">
                            <img src="#" alt=""/>
                        </div>
                        <div class="text fl">
                            周鸿祎的互联网方法论</br>互网法论
                        </div>
                    </div>
                    <div class="small-article ml-20">
                        <div class="bg-click fl mt-10">
                            <img src="#" alt=""/>
                        </div>
                        <div class="text fl">
                            周鸿祎的互联网方法论</br>互网法论
                        </div>
                    </div>
                    <div class="small-article ml-20">
                        <div class="bg-click fl mt-10">
                            <img src="#" alt=""/>
                        </div>
                        <div class="text fl">
                            周鸿祎的互联网方法论</br>互网法论
                        </div>
                    </div>
                    <div class="small-article ml-20">
                        <div class="bg-click fl mt-10">
                            <img src="#" alt=""/>
                        </div>
                        <div class="text fl">
                            周鸿祎的互联网方法论</br>互网法论
                        </div>
                    </div>
                    <div class="small-article ml-20">
                        <div class="bg-click fl mt-10">
                            <img src="#" alt=""/>
                        </div>
                        <div class="text fl">
                            周鸿祎的互联网方法论</br>互网法论
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    <!-- 二维码-->
                    <div class="qrcode">
                        <div class="text fs-12 lp-2">微信公众平台：搜索“创新设计”或扫描一下二维码:</div>
                        <img src="#" alt="" width="155" height="155" />
                    </div>

                </div>
            </div>
        </div>
    </div>  
</div>
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="/js/post.js"></script>
