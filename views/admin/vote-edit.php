
<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css?v=<? echo param('version'); ?>" />

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/vote-menu', ['section' => '1-1']) ?>
        </div>

        <div class="col-md-10 vote">
            <a class="btn btn-primary" href="javascript:;" onclick="save()" >保存</a>
            <div class="clear-30"></div>            

            <div class="form-horizontal col-md-8">
                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">议题配置名</label>
                    <div class="col-sm-6"><input type="text" id="vote-name" class="form-control" value="<?= @$vote->name ?>" placeholder="议题配置名"></div> 
                </div>         
                <div class="clear-2"></div>    

                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">最少选择项数</label>
                    <div class="col-sm-6"><input type="text" id="vote-min" class="form-control" value="<?= @$vote->min_option ?>" placeholder="最少选择项数"></div>          
                </div>
                <div class="clear-2"></div>    
                
                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">最大选择项数</label>
                    <div class="col-sm-6"><input type="text" id="vote-max" class="form-control" value="<?= @$vote->max_option; ?>" placeholder="最大选择项数"></div>          
                </div>
                <div class="clear-2"></div>  
            </div>
            <div class="clear-2"></div>  

            <a class="btn btn-success" href="javascript:;" onclick="addQuestion()" >添加题目</a>
            <div class="clear-10"></div>
            <ul id="question-holder" class="question-holder">
                <?
                foreach ($vote->questionList as $question)
                {
                    $config = json_decode($question->data, true);
                ?>
                <li class="question well">
                    <input type="text" class="user form-control" value="<?= $config['user_id'] ?>" placeholder="用户ID" /> 
                    <input type="text" class="name form-control" value="<?= $question->name ?>" placeholder="议题名"  /> 
                    <div class="action-holder">
                        <a class="action fs-20" title="删除议题" href="javascript:;" onclick="removeQuestion(this)"><i class="fa fa-remove ml-10"></i></a>                        
                    </div>
                </li>
                <?
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
var vote_id = <?= $vote->id ? $vote->id : 0; ?>;
</script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/admin/vote-edit.js"></script> 


