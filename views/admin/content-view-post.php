<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\Post;

$index_post_data = getConfig(DXConst::KEY_CONFIG_VIEW_POST);


if($index_post_data != null)
{
    $index_post = json_decode($index_post_data,true);
    $post1_id = intval($index_post['post']['post1']);
    // dump($post1_id);
    $post2_id = intval($index_post['post']['post2']);
    $post1 = Post::find()->where(['id' => $post1_id])->one();
    // dump($post1);die();
}
else
{
    $post1_id = 100;
    $post2_id = 99;
}

$post1 = Post::find()->where(['id' => $post1_id])->one();
$post2 = Post::find()->where(['id' => $post2_id])->one();
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
                    <label class="col-sm-2 control-label">第一篇文章(ID)</label>
                    <div class="col-sm-6"><input type="text" id="post1" class="form-control" placeholder="ID: " value = "<?= $post1->id?>"/></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">第二篇文章(ID)</label>
                    <div class="col-sm-6"><input type="text" id="post2" class="form-control" placeholder="ID: " value = "<?= $post2->id?>"/></div>
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
