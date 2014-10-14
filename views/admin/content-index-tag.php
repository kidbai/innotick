<?

 $section = '1-2';

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
            <div class="btn btn-success">添加焦点图</div>
            <div class="clear-15"></div>
            <div id="hot-holder">
                <div class="hot panel panel-default col-md-7">
                    <div class="panel-body">
                        <img class="bg" width="180" height="90" src="">
                        <input type="hidden" id="hot-img" value="" />
                        <input type="text" id="hot-url" placeholder="链接" value="" class="form-control url">
                        <div class="clear-20"></div>
                        <div class="action">
                            <div class="fl">
                                <span class="btn btn-success fl file-upload-btn" >
                                    上传<input type="file" id="file-upload" name="file" />
                                </span>
                                <span class="fl file-upload-status" id="file-upload-status"></span>
                            </div>
                            <a class="btn btn-danger fr" href="javascript:;" onclick="" >删除</a>
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
