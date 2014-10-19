<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\Post;

$view_post_data = getConfig(DXConst::KEY_CONFIG_VIEW_POST);


if($view_post_data != null)
{
    $index_post = json_decode($view_post_data,true);
    $hot_post_list = @$index_post['post'];
    $hot_post_list = implode('-', $hot_post_list);
}


$post_all = Post::find()->orderBy('id')->all();
$post_id_list = array();
foreach ($post_all as $post)
{
    array_push($post_id_list, $post->id);
}
$post_id_list = json_encode($post_id_list,true);
// dump($post_id_list);die();

 $section = '2-1';

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
                    <div class="col-sm-6"><input type="text" id="post" class="form-control" placeholder="ID: " value = "<?= $hot_post_list?>"/></div>
                </div>
                <div class="clear-2"></div>
                
                
                <div class="clear-20"></div>            
                                                                                        
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save(<?= $post_id_list?>)">保存</button>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-view-post.js"></script>
