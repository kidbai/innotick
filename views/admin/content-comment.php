<?
use yii\widgets\ActiveForm;
use app\component\DXConst;
use yii\widgets\ListView;
use app\component\BootstrapPager;


$section = '4-1';

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
            <div class="form-horizontal" >
                <div class="clear-5"></div>
                <?php
                echo ListView::widget([
                    'dataProvider' => $provider,
                    'itemView' => '/admin/post-comment-item-view',
                    'layout' => '<div class="table-holder">
                                    <table class="table table-condensed table-hover table-bordered data-table">
                                        <thead>
                                          <tr>
                                            <th class="tc">编辑</th>
                                            <th class="tc">删除</th>
                                            <th class="tc">ID</th>
                                            <th class="tc">标题</th>
                                            <ht class="tc">查看评论内容</th>
                                            <th class="tc">发布时间</th>
                                            <th class="tc">更新时间</th>
                                            <th class="tc">发布者</th>
                                          </tr>
                                        </thead>
                                      {items}  
                                      </table>
                                  </div>
                                  <div class="clear"></div>
                                  {pager}',
                    'separator' => '',
                    'emptyText' => '',
                    'pager' => [
                        'class' => '\app\component\BootstrapPager'
                     ]
                ]);
                ?>                
            </div>
        </div> 
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-tag.js"></script>
