<?
$category_map = [
    1 => '网站',
    2 => '应用',
    3 => '硬件',
    4 => '品牌',
    5 => '创意',
    6 => '观点'
];

$post_fav = $model;
// dump($model);die();
?>
<div class="collection-cont mr-20 ml-20">
    <div class="collection-green site fl ml-38 category"><?= @$category_map[$post_fav->post->category_id] ?></div>
    <div class="title fl ml-46" onclick="location='<?= $post_fav->post->url?>'"><?= mb_substr($post_fav->post->title, 0, 20, 'utf-8') ?></div>
    <div class="fr comment-num mr-60"><?= $post_fav->post->commentCount ?></div>
    <div class="fr time mr-50"><?= timeFormat($post_fav->created, 'ago') ?></div>
</div>