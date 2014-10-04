<?
$category_map = [
    1 => '网站',
    2 => '应用',
    3 => '硬件',
    4 => '品牌',
    5 => '创意',
    6 => '观点'
];

$desc = trim(strip_tags($post->content));
$desc = mb_substr($desc, 0, 80);
?>

<div id="post-<?= $post->id ?>" data-id="<?= $post->id ?>" class="post border-bottom-1">
    <div class="img-holder">
        <img src="/upload/img/<?= $post->img ?>" width="260" height="180"/>
        <div class="icon-type">   <!-- 44 x 25 -->
            <img src="/img/icon/tag<?= $post->category_id ?>.png" alt=""/>
            <div class="tag3-text"><?= @$category_map[$post->category_id] ?></div>
            <!-- <div style="background:url('/img/icon/tag3.png') no-repeat;width:44px;height:25px"><p class="fs-10">网站</p></div> -->
        </div>
    </div>  
    <div class="text">
        <div class="title"><a class="fs-21 lp-3" href="<?= $post->url ?>"><?= $post->title ?></a></div>
        <div class="fs-10 lp-1 post-label fl">作者<strong class="ml-4 author"><?= $post->author ?></strong> - <?= timeFormat($post->created) ?> </div>
        <div class="clear"></div>
        <div class="fs-15 lp-2 content"><?= $desc ?>...<a class="fs-15 read-all" href="<?= $post->url ?>">阅读全文</a></div>
        
    </div>
    <div class="tag-label">
        <div class="tag-label-like">
            <img src="/img/icon/red-long.png" alt=""/>
            <div class="words-save">保存这篇文章</div>
        </div>
        <div class="tag-label-like-recall">
            <img src="/img/icon/red.png" alt=""/>   
            <div class="words-like-recall">撤回</div>
        </div>
        <div class="tag-label-more">
            <img src="/img/icon/green-long.png" alt=""/>
            <div class="words-more">更多这类文章</div>
        </div>
        <div class="tag-label-more-recall">
            <img src="/img/icon/green.png" alt="">
            <div class="words-more-recall">撤回</div>
        </div>
        <div class="tag-label-del">
            <img src="/img/icon/blue-long.png" alt=""/>
            <div class="words-del">删除这类文章</div>
        </div>
        <div class="tag-label-del-recall">
            <img src="/img/icon/blue.png" alt="">
            <div class="words-del-recall">撤回</div>
        </div>
    </div>  
    <div class="tag-list">
        <div class="tag-like ml-1">
            <img src="/img/icon/save.png" width="15" height="15" alt=""/>
        </div>
        <div class="tag-add-cont fl ml-1">
            <div class="tag-add active">
                <img src="/img/icon/more2.png" width="15" height="15" alt=""/>
            </div>
            <div class="tag-add-green active">
                <img src="/img/icon/more.png" width="15" height="15" alt=""/>
            </div>
            <div class="tag-add-cancel">
                <img src="/img/icon/cancel.png" width="15" height="15" alt=""/>
            </div>
        </div>
        <div class="tag-del-cont">
            <div class="tag-del ml-1">
                <img src="/img/icon/delete.png" width="25" height="30" alt=""/>
            </div>
            <div class="tag-del-dark">
                <img src="/img/icon/delete-dark.png" width="25" height="30" alt=""/>
            </div>
        </div>
        
    </div>
</div>

