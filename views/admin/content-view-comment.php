<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\Post;
use app\models\PostComment;

 
$view_comment_data = getConfig(DXConst::KEY_CONFIG_VIEW_COMMENT);
if($view_comment_data != null)
{
    $view_comment = json_decode($view_comment_data,true);
    $hot_comment = @$view_comment['comment'];
    $hot_comment_list = implode('-', $hot_comment);
}


$view_comment_all = PostComment::find()->orderBy('id')->all();
$comment_id_list = array();
foreach ($view_comment_all as $comment)
{
    array_push($comment_id_list, $comment->id);
}
$comment_id_list = json_encode($comment_id_list, true);
 $section = '2-2';

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
                    <label class="col-sm-2 control-label">文章(ID,用'-'符号分开)</label>
                    <div class="col-sm-6"><input type="text" id="comment" class="form-control" placeholder="ID: " value = "<?= $hot_comment_list?>"/></div>
                </div>
                
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
<script type="text/javascript" src="/js/admin/change-view-comment.js"></script>
