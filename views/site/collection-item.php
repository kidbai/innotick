<?
foreach ($post_fav_list as $post_fav)
{
    echo $this->render('//collection-template', ['post_fav' => $post_fav]);
}
?> 