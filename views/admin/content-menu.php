<ul class="nav-menu dropdown-menu" style="display: block; margin-left: 20px;  ">
    <li class="dropdown-header">首页管理</li>
    <li class="<? if ($section == '1-1') echo 'active'; ?>"><a href="<?= url(['/admin/content-index-big-pic']) ?>">首页大图</a></li>
    <li class="<? if ($section == '1-2') echo 'active'; ?>"><a href="<?= url(['/admin/content-index-tag']) ?>">首页标签</a></li>
    <li class="<? if ($section == '1-3') echo 'active'; ?>"><a href="<?= url(['/admin/content-index-post']) ?>">首页文章</a></li>
    <li class="<? if ($section == '1-4') echo 'active'; ?>"><a href="<?= url(['/admin/content-index-comment']) ?>">首页评论列表</a></li>
    <li class="dropdown-header">文章页管理</li>
    <li class="<? if ($section == '2-1') echo 'active'; ?>"><a href="<?= url(['/admin/content-post-hot-post']) ?>">文章内右侧热门文章</a></li>
    <li class="<? if ($section == '2-2') echo 'active'; ?>"><a href="<?= url(['/admin/content-post-hot-comment']) ?>">文章内右侧热门评论</a></li>
    <li class="dropdown-header">轮播页管理</li>
    <li class="<? if ($section == '3-1') echo 'active'; ?>"><a href="<?= url(['/admin/content-special-column']) ?>">专栏</a></li>
   <!--  <li class="dropdown-header">文章评论管理</li>
    <li class="<? if ($section == '4-1') echo 'active'; ?>"><a href="<?= url(['/admin/content-comment']) ?>">评论内容管理</a></li> -->
</ul>