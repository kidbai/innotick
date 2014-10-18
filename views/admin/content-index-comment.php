<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\PostComment;

$index_comment_data = getConfig(DXConst::KEY_CONFIG_INDEX_COMMENT);
if($index_comment_data != null)
{
    $index_comment = json_decode($index_comment_data, true);
    // dump($index_comment);die();
    $comment = @$index_comment['comment'];
    $comment_list = implode('-', $comment);
}



$comment_all = PostComment::find()->orderBy('id')->all();
$comment_id_list = array();
foreach ($comment_all as $comment)
{
    array_push($comment_id_list, $comment->id);
}
$comment_id_list = json_encode($comment_id_list,true);
// dump($comment_id_list);die();

 $section = '1-4';

?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/content-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-8">
            <div class="form-horizontal" >
                <div class="clear-5"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">评论(ID,用'-'符号分开)</label>
                    <div class="col-sm-6"><input type="text" id="comment" class="form-control" placeholder="" value = "<?= $comment_list?>"/></div>
                </div>
                <div class="clear-2"></div>
                
                <div class="clear-20"></div>            
                                                                                        
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save(<?= $comment_id_list?>)">保存</button>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-comment.js"></script>
