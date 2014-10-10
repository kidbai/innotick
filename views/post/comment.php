<?
$i = 0;
foreach ($comment_list as $comment)
{
    $i++;
    echo $this->render('/post/comment-item', ['comment' => $comment, 'i' => $i]);
}
?> 