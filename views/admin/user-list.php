<?php
use yii\widgets\ListView;
use app\component\BootstrapPager;

$section = '1-1';

?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/user-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-10">
            <div class="">
                <a href="/admin/user-edit" class="btn btn-success ml-15">添加用户</a>
            </div>
            <div class="clear-10"></div>

            <?php
            echo ListView::widget([
                'dataProvider' => $provider,
                'itemView' => '/admin/user-list-item-view',
                'layout' => '<div class="table-holder col-md-8">
                                <table class="table table-condensed table-hover table-bordered data-table">
                                    <thread>
                                      <tr>
                                        <th class="tc">编辑</th>
                                        <th class="tc">删除</th>
                                        <th class="tc">ID</th>
                                        <th class="tc">姓名</th>
                                        <th class="tc">手机号</th>
                                        <th class="tc">公司</th>
                                        <th class="tc">职位</th>
                                      </tr>
                                    </thred>
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


<script type="text/javascript" src="/js/admin/user-list.js"></script>
