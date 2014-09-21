<?php
use yii\widgets\ListView;
use app\component\BootstrapPager;

$section = '1-1';

?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/post-menu', ['section' => $section]) ?>
        </div>

        <div class="col-md-10">

            <div class="">
                <a href="/admin/post-edit" class="btn btn-success ml-15">添加文章</a>
            </div>
            <div class="clear-10"></div>

            <?php
			echo ListView::widget([
			    'dataProvider' => $provider,
			  	'itemView' => '/admin/post-list-item-view',
			  	'layout' => '<div class="table-holder col-md-8">
			  					<table class="table table-condensed table-hover table-bordered data-table">
				                    <thread>
				                      <tr>
				                      	<th class="tc">编辑</th>
				                        <th class="tc">删除</th>
				                        <th class="tc">ID</th>
				                        <th class="tc">标题</th>
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


<script type="text/javascript" src="/js/admin/post-list.js"></script>
