<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use app\models\Post;
use app\models\PostComment;

$key = DXConst::KEY_CONFIG_SPECIAL_COLUMN;
$special_list = [];
$special_list_data = getConfig(DXConst::KEY_CONFIG_SPECIAL_COLUMN);
if($special_list_data != null)
{
    $special_list = json_decode($special_list_data, true);
}
$special_list = $special_list ? $special_list : [];

$section = '3-1';

?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/content-menu', ['section' => $section]) ?>
        </div>
        <div class="col-md-10">
            <div id="picture-holder" class="ad img-upload-url panel panel-default col-md-7" num="">

                <?
                $i = 0;
                foreach ($special_list as $special )
                {
                    $i++;
                ?>
                <div class="panel-body" id="<?= $i ?>">
                    <img id="pic-<?= $i ?>" class="bg" width="180" height="90" src="/upload/img/<?= $special['img']?>">
                    <input type="hidden" id="special-column-img-<?= $i ?>" value="<?= $special['img']?>" />
                    <input type="text" id="special-post-<?= $i ?>" placeholder="文章ID" value="<?= $special['post_id']?>" class="form-control title">
                    <div class="clear-20"></div>
                    <div class="action">
                        <div class="fl">
                            <span class="btn btn-success fl file-upload-btn" >
                                上传<input type="file" id="file-upload-<?= $i ?>" name="file" /> 
                            </span> 
                            <span class="fl file-upload-status" id="file-upload-status-<?= $i ?>"></span>
                        </div>
                        <a class="btn btn-danger fr" href="javascript:;" onclick="del(<?= $i ?>)" >删除</a>
                    </div>
                </div>

                <?
                }
                ?> 
               
            </div>
            <div class="clear-15"></div>
            <a class="btn btn-primary" href="javascript:;" onclick="add()" >添加</a>
            <a class="btn btn-primary" href="javascript:;" onclick="save('<?= $key ?>')" >保存</a>
            <div class="clear-40"></div>
        </div>  
    </div>
</div>

<script>
try
{
    var special_list = <?= json_encode($special_list) ?>;
}
catch (e)
{
    
}
var special_count = special_list.length;
console.log(special_count+"!@#!@#");
</script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-special-column.js"></script>
