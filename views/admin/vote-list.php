<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/vote-menu', ['section' => '1-1']) ?>
        </div>

        <div class="col-md-10">
            <a class="btn btn-success" href="/admin/vote-edit">添加投票</a>
            <div class="clear-20"></div>
            <table class="table table-condensed table-hover table-bordered data-table" style="width: 400px;">
                <thread>
                  <tr>
                    <th class="tc">编辑</th>
                    <th class="tc">删除</th>
                    <th>问卷名</th>
                  </tr>
                </thred>                
                <?
                foreach ($vote_list as $vote)
                {
                    $edit_url = url(['/admin/vote-edit', 'id' => $vote->id]);
                ?>
                    <tr>
                        <td class="tc"><a href="<?= $edit_url ?>">编辑</a></td>
                        <td class="tc"><a href="javascript:;" onclick="deleteVote(<?= $vote->id ?>)">删除</a></td>
                        <td id="vote-<?= $vote->id ?>-name"><?= $vote->name ?></td>
                    </tr>
                <?
                }
                ?>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript" src="/js/admin/vote-list.js"></script> 