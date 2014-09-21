<?php
use yii\widgets\ActiveForm;

$section = '1-1';

$member_ids = '';
foreach ($meeting->members as $user)
{
    $member_ids .= $user->id . '-';
}
$member_ids = trim(trim($member_ids), '-');
?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />
<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-6">
            <div class="form-horizontal">
                <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-2">
                        <h4>会议成员</h4>
                    </div>
                </div>            
                <div class="clear-2"></div>

                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">主持人</label>
                    <div class="col-sm-6"><input type="text" id="host" class="form-control" value="<?= @$meeting->host->id ?>" placeholder="用户ID"></div> 
                </div>         
                <div class="clear-2"></div>    

                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">参会者</label>
                    <div class="col-sm-6"><input type="text" id="member" class="form-control" value="<?= @$member_ids ?>" placeholder="用户ID，用“-”分割，如“1-2-3-4-5-6-7-8-9-10”"></div>          
                </div>
                <div class="clear-2"></div>    
                
                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">助理</label>
                    <div class="col-sm-6"><input type="text" id="assistant" class="form-control" value="<?= @$meeting->assistant->id ?>" placeholder="用户ID"></div>          
                </div>
                <div class="clear-2"></div>  

                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">评论员</label>
                    <div class="col-sm-6"><input type="text" id="commentator" class="form-control" value="<?= @$meeting->commentator->id ?>" placeholder="用户ID"></div>          
                </div>
                <div class="clear-2"></div>  

                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">记录员</label>
                    <div class="col-sm-6"><input type="text" id="recorder" class="form-control" value="<?= @$meeting->recorder->id ?>" placeholder="用户ID"></div>          
                </div>
                <div class="clear-2"></div> 

                <div class="form-group ">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save()">保存</button>
                    </div>
                </div>                   
            </div>
            
                                                              
        </div>    
    </div>
</div>

<div class="clear-40"></div>

<script type="text/javascript">
var meeting_id = <?= $meeting->id ?>;
</script>
<script type="text/javascript" src="/js/admin/user-member-edit.js"></script>

