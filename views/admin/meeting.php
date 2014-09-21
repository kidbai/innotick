<?php
use yii\widgets\ActiveForm;

$section = '1-1';
?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/meeting-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-10 meeting">
            <div class="">
                <a href="/admin/meeting-edit?id=<?= $meeting->id ?>" class="btn btn-success">修改会议信息</a>
                <a href="/admin/meeting-member-edit?id=<?= $meeting->id ?>" class="btn btn-success ml-5">修改会议成员</a>
                <a href="javascript:;" class="btn btn-danger ml-5" onclick="endMeeting()">结束会议</a>
            </div>
            <div class="clear-10"></div>

            <div class="info well">
            	<div class="section">
                    <div class="title">会议名：</div>
                    <div class="content"><?= $meeting->name ?></div>
                </div>
            	<div class="section">
                    <div class="title">会议介绍：</div>
                    <div class="content"><?= $meeting->desc ?></div>
                </div>
            	<div class="section">
                    <div class="title">会议时长：</div>
                    <div class="content"><?= $meeting->time ?>分钟</div>
                </div>
            	<div class="section">
                    <div class="title">主持人：</div>
                    <div class="content"><a href="javascript:;" onclick="openSendMsg(<?= @$meeting->host->id ?>);"><?= @$meeting->host->name ?></a></div>
                </div>
                <div class="section">
                    <div class="title">成员：</div>
                    <div class="content">
                    <?
                    foreach ($meeting->members as $user)
                    {
                    ?>
                        <a href="javascript:;" onclick="openSendMsg(<?= $user->id ?>);" class="mr-10 "><?= $user->name ?></a>
                    <?
                    }
                    ?>
                    </div>
                </div>
                <div class="section">
                    <div class="title">助理：</div>
                    <div class="content"><a href="javascript:;" onclick="openSendMsg(<?= @$meeting->assistant->id ?>);"><?= @$meeting->assistant->name ?></a></div>
                </div> 
                <div class="section">
                    <div class="title">评论员：</div>
                    <div class="content"><a href="javascript:;" onclick="openSendMsg(<?= @$meeting->commentator->id ?>);"><?= @$meeting->commentator->name ?></a></div>
                </div>               
                <div class="section">
                    <div class="title">记录员：</div>
                    <div class="content"><a href="javascript:;" onclick="openSendMsg(<?= @$meeting->recorder->id ?>);"><?= @$meeting->recorder->name ?></a></div>
                </div>                                  
                <div class="clear-2"></div>
            </div>
            <div class="clear-10"></div>

            <div id="process-holder"></div>
            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">          
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">发送消息</h4>
            </div>
            <input type="hidden" id="user-id" />
            <div class="modal-body">
                <div class="form-horizontal" >
                    <div class="clear-5"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">消息内容</label>
                        <div class="col-sm-8"><input type="text" id="msg" class="form-control" placeholder="消息内容"></div>
                    </div>
                    <div class="clear-5"></div>          
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="sendMsg()">发送</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
var meeting_id = <?= $meeting->id ?>;
</script>
<script type="text/javascript" src="/js/admin/meeting.js"></script>