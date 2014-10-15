<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\PostComment;

$index_comment_data = getConfig(DXConst::KEY_CONFIG_INDEX_COMMENT);
if($index_comment_data != null)
{
    $index_comment = json_decode($index_comment_data, true);
    $comment1_id = $index_comment['comment']['comment1'];
    $comment2_id = $index_comment['comment']['comment2'];
    $comment3_id = $index_comment['comment']['comment3'];
}
else
{
    $comment1_id = 10;  //default
    $comment2_id = 11;  //default
    $comment3_id = 12;  //default
}

$comment1 = PostComment::find()->where(['id' => $comment1_id])->one();
$comment2 = PostComment::find()->where(['id' => $comment2_id])->one();
$comment3 = PostComment::find()->where(['id' => $comment3_id])->one();
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
                    <label class="col-sm-2 control-label">第一条评论(ID)</label>
                    <div class="col-sm-6"><input type="text" id="comment1" class="form-control" placeholder="" value = "<?= $comment1->id?>"/></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">第二条评论(ID)</label>
                    <div class="col-sm-6"><input type="text" id="comment2" class="form-control" placeholder="" value = "<?= $comment2->id?>"/></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">第三条评论(ID)</label>
                    <div class="col-sm-6"><input type="text" id="comment3" class="form-control" placeholder="" value = "<?= $comment3->id?>"/></div>
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
