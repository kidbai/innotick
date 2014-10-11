     <?
$category_map = [
    1 => '网站',
    2 => '应用',
    3 => '硬件',
    4 => '品牌',
    5 => '创意',
    6 => '观点'
];

?>
<div class="collection-cont mr-20 ml-20">
    <div class="collection-green site fl ml-38 category"><?= @$category_map[$post_fav->category_id] ?></div>
    <div class="title fl ml-46"></div>
    <div class="fr comment-num mr-60">22123</div>
    <div class="fr time mr-50"><?= timeFormat($post_fav->created, 'ago') ?></div>
</div>