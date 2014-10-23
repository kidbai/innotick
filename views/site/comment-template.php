
<div class="block border-bottom-1" >
    <div class="circle mt-20 fl bg-orange"></div>
    <div class="fl mt-20 ml-10 text">
        <div class="fl fs-14 orange">人生路</div>
        <div class="fl fs-14 gray-1 bold ml-5">·</div>
        <div class="fl ml-5"><p class="l-designer fs-13 lp-1">3小时前</p></div>
        <div class="fr"><a href="#"><img class="fl mr-3" src="/img/icon/floor.png" width="15" height="15" alt=""/><p class="l-designer fs-13 fl">1楼</p></a></div>
        <div class="clear"></div>
        <div class="l-designer fs-14 mt-12 fl"><?= $post_comment->content?></div>
        <ul class="fr mt-13">
            <li class="fl " id="<?= $comment->id?>" onclick="comment_like(<?= $post->id?>, this.id)"><div class="fs-13 l-designer like">顶(<? echo $post_comment->commentlikecount ?>)</div></li>
            <li class="fl  ml-15" id="<?= $comment->id?>" onclick="comment_dislike(<?= $post->id?>, this.id)"><div class="fs-13 l-designer dislike">踩(<? echo $post_comment->commentdislikecount ?>)</div></li>
        </ul>
    </div>
</div> 