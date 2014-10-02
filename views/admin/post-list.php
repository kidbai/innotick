<?php
use yii\widgets\ListView;
use app\component\BootstrapPager;

$section = '1-' . $category_id;

?>

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/post-menu', ['section' => $section, 'category' => $category]) ?>
        </div>

        <div class="col-md-10">
            <div class="">
                <a href="/admin/post-edit?category_id=<?= $category_id ?>" class="btn btn-success">发布文章</a>
            </div>
            <div class="clear-10"></div>

            <?php
			echo ListView::widget([
			    'dataProvider' => $provider,
			  	'itemView' => '/admin/post-list-item-view',
			  	'layout' => '<div class="table-holder">
			  					<table class="table table-condensed table-hover table-bordered data-table">
				                    <thead>
				                      <tr>
				                      	<th class="tc">编辑</th>
				                        <th class="tc">删除</th>
				                        <th class="tc">ID</th>
				                        <th class="tc">标题</th>
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


<script type="text/javascript" src="/js/admin/post-list.js"></script>
