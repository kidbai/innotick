
<link rel="stylesheet" href="/res/font-awesome/css/font-awesome.min.css?v=<? echo param('version'); ?>" />

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/questionnaire-menu', ['section' => '1-1']) ?>
        </div>

        <div class="col-md-10 questionnire">
            <a class="btn btn-primary" href="javascript:;" onclick="save()" >保存</a>
            <div class="clear-30"></div>            

            <div class="form-horizontal col-md-8">
                <div class="form-group  field-user-name required">
                    <label class="col-sm-2 control-label">问卷名</label>
                    <div class="col-sm-6"><input type="text" id="questionnaire-name" class="form-control" value="<?= @$questionnaire->name ?>" placeholder="问卷名"></div> 
                </div>         
                <div class="clear-2"></div>    
            </div>
            <div class="clear-2"></div>                      

            <a class="btn btn-success" href="javascript:;" onclick="addQuestion()" >添加题目</a>
            <div class="clear-10"></div>
            <ul id="question-holder" class="question-holder">
                <?
                $i = 0;
                foreach ($questionnaire->questionList as $question)
                {
                    $i++;
                    $option_list = json_decode($question->data, true);
                    if (!$option_list)
                    {
                        $option_list = [];
                    }
                ?>
                <li class="question">
                    <div class="name">
                        <input type="text" class="name form-control" value="<?= $question->name ?>" />
                        <div class="action-holder">
                            <a class="action fs-20" title="添加选项" href="javascript:;" onclick="addOption(this)"><i class="fa fa-plus-square"></i></a>
                            <a class="action fs-20" title="删除本题" href="javascript:;" onclick="removeQuestion(this)"><i class="fa fa-remove ml-10"></i></a>                        
                        </div>
                    </div>
                    <ul class="option-holder">
                    <?
                    foreach ($option_list as $option)
                    {
                    ?>
                        <li class="option">
                            <input type="text" class="option form-control" value="<?= $option['content'] ?>" />
                            <div class="action-holder">
                                <a class="action fs-20" title="删除选项" href="javascript:;" onclick="removeOption(this)"><i class="fa fa-remove"></i></a>
                            </div>
                        </li>
                    <?
                    }
                    ?>
                    </ul>
                </li>
                <?
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
var questionnaire_id = <?= $questionnaire->id ? $questionnaire->id : 0; ?>;
</script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/admin/questionnaire-edit.js"></script> 


