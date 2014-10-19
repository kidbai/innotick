<?
use yii\widgets\ActiveForm;
use app\component\DXConst;

$index_tag_data = getConfig(DXConst::KEY_CONFIG_INDEX_TAG);

if($index_tag_data != null)
{
    $index_tag = json_decode($index_tag_data, true);
    // dump($index_tag) ;dump($index_tag['tag']['tag1']);die();

}
else
{
    $index_tag['tag']['tag1'] = '小米';
    $index_tag['tag']['tag2'] = 'Tesla';
    $index_tag['tag']['tag3'] = 'Oculus';
    $index_tag['tag']['tag4'] = 'Uber';
    $index_tag['tag']['tag5'] = '比特币';
    $index_tag['tag']['tag6'] = 'More';
  
}


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
                    <label class="col-sm-2 control-label">第一个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag1" class="form-control" value = "<?= $index_tag['tag']['tag1']?>"/></div>
                </div>
                <div class="clear-2"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">第二个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag2" class="form-control" placeholder="tag2" value = "<?= $index_tag['tag']['tag2']?>"/></div>
                </div>
                <div class="clear-2"></div> 

                <div class="form-group">
                    <label class="col-sm-2 control-label">第三个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag3" class="form-control" placeholder="tag3" value = "<?= $index_tag['tag']['tag3']?>"/></div>
                </div>

                <div class="clear-5"></div>    
                <div class="form-group">
                    <label class="col-sm-2 control-label">第四个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag4" class="form-control" placeholder="tag4" value = "<?= $index_tag['tag']['tag4']?>"/></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">第五个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag5" class="form-control" placeholder="tag5" value = "<?= $index_tag['tag']['tag5']?>"/></div>
                </div>  
                <div class="clear-5"></div>    

                <div class="form-group">
                    <label class="col-sm-2 control-label">第六个Tag</label>
                    <div class="col-sm-6"><input type="text" id="tag6" class="form-control" placeholder="tag6" value = "<?= $index_tag['tag']['tag6']?>"/></div>
                </div>
                <div class="clear-20"></div>            
                                                                                        
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save()">保存</button>
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
