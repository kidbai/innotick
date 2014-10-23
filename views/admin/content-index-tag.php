<?
use yii\widgets\ActiveForm;
use app\component\DXConst;

$key = DXConst::KEY_CONFIG_INDEX_TAG;

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

        
        <div class="col-md-8">
            <div class="form-horizontal" >
                <div class="clear-5"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">标签列表</label>
                    <div class="col-sm-6"><input type="text" id="tag" class="form-control" placeholder="标签之间用“-”分割" value = "<?= getConfig($key) ?>"/></div>
                </div>
                <div class="clear-2"></div>

                                                                                        
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save('<?= $key ?>')">保存</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-tag.js"></script>
