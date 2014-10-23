<?
use app\component\DXConst;

$key = DXConst::KEY_CONFIG_INDEX_PIC;

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
            <div class="clear-15"></div>
            <div id="picture-holder">
                <div class="picture col-md-7">
                    <div class="">
                        <img class="bg" width="180" height="90" src="/upload/img/<?= getConfig($key) ?>">
                        <input type="hidden" id="pic" value="<?= getConfig($key) ?>" />
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

            <div class="clear-30"></div>
            <a class="btn btn-primary" href="javascript:" onclick="save('<?= $key ?>')" >保存</a>
            <div class="clear-40"></div>
        </div>        
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-pic.js"></script>
