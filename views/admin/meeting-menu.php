<ul class="nav-menu dropdown-menu" style="display: block; margin-left: 20px;  ">
    <li class="dropdown-header">会议管理</li>
    <li class="<? if ($section == '1-1') echo 'active'; ?>"><a href="<?= url(['/admin/meeting']) ?>">会议信息</a></li>
    <li class="<? if ($section == '1-2') echo 'active'; ?>"><a href="<?= url(['/admin/agenda-list']) ?>">会议配置</a></li>
</ul>