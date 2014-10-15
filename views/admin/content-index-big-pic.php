<?
use app\component\DXConst;
$index_pic_data = getConfig(DXConst::KEY_CONFIG_INDEX_PIC);
// dump($index_pic_data);die();
if ($index_pic_data != null)
{
    $index_pic = json_decode($index_pic_data, true);
}
else
{
    $index_pic[0]['img'] = "background.jpg";    
    $index_pic[0]['url'] = "can not find";
}
 $section = '1-1';

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
            <div class="btn btn-success">首页大图</div>
            <div class="clear-15"></div>
            <div id="picture-holder">
                <div class="picture panel panel-default col-md-7">
                    <div class="panel-body">
                        <img class="bg" width="180" height="90" src="/upload/img/<?= $index_pic[0]['img']?>">
                        <input type="hidden" id="pic" value="<?= $index_pic[0]['img']?>" />
                        <input type="text" id="pic-url" value="<?= $index_pic[0]['url']?>" class="form-control url">
                        <div class="clear-20"></div>
                        <div class="action">
                            <div class="fl">
                                <span class="btn btn-success fl file-upload-btn" >
                                    上传<input type="file" id="file-upload" name="file" />
                                </span>
                                <span class="fl file-upload-status" id="file-upload-status"></span>
                            </div>
                            <!-- <a class="btn btn-danger fr" href="javascript:;" onclick="" >删除</a> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="clear-15"></div>
            <a class="btn btn-primary" href="javascript:;" onclick="save()" >保存</a>
            <div class="clear-40"></div>
        </div>        
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-pic.js"></script>
