<?

 $section = '1-2';

?>

<link href="/res/datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" />
<link href="/res/jqueryfileupload/jquery.fileupload.css" rel="stylesheet" />

<div class="clear-20"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('/admin/content-menu', ['section' => $section]) ?>
        </div>

        
        <div class="col-md-8">
            <div class="form-horizontal" >
                <div class="clear-5"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">头条标题</label>
                    <div class="col-sm-6"><input type="text" id="post-title" value="<?= @$post['title'] ?>" class="form-control" placeholder="标题"></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">头条链接</label>
                    <div class="col-sm-6"><input type="text" id="post-url" value="<?= @$post['url'] ?>" class="form-control" placeholder="链接"></div>
                </div>
                <div class="clear-2"></div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label">头条描述</label>
                    <div class="col-sm-6"><input type="text" id="post-desc" value="<?= @$post['desc'] ?>" class="form-control" placeholder="描述"></div>

                </div>
                <div class="clear-20"></div>    


                <div class="form-group">
                    <label class="col-sm-2 control-label">小文章1标题</label>
                    <div class="col-sm-6"><input type="text" id="post-1-title" value="<?= @$post1['title'] ?>" class="form-control" placeholder="标题"></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">小文章1链接</label>
                    <div class="col-sm-6"><input type="text" id="post-1-url" value="<?= @$post1['url'] ?>" class="form-control" placeholder="链接"></div>
                </div>  
                <div class="clear-20"></div>    


                <div class="form-group">
                    <label class="col-sm-2 control-label">小文章2标题</label>
                    <div class="col-sm-6"><input type="text" id="post-2-title" value="<?= @$post2['title'] ?>" class="form-control" placeholder="标题"></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">小文章2链接</label>
                    <div class="col-sm-6"><input type="text" id="post-2-url" value="<?= @$post2['url'] ?>" class="form-control" placeholder="链接"></div>
                </div>  
                <div class="clear-20"></div>    


                <div class="form-group">
                    <label class="col-sm-2 control-label" >小文章3标题</label>
                    <div class="col-sm-6"><input type="text" id="post-3-title" value="<?= @$post3['title'] ?>" class="form-control" placeholder="标题"></div>
                </div>
                <div class="clear-2"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >小文章3链接</label>
                    <div class="col-sm-6"><input type="text" id="post-3-url" value="<?= @$post3['url'] ?>" class="form-control" placeholder="链接"></div>
                </div>  
                <div class="clear-20"></div>    



                <div class="form-group">
                    <label class="col-sm-2 control-label" >banner</label>
                    <div class="hot panel panel-default col-sm-6 ml-15">
                        <div id="banner" class="panel-body">
                            <img class="bg" width="180" height="90" src="<?= imgUrlPrefix() ?>/upload/img/<?= @$banner['img'] ?>">
                            <input type="hidden" id="banner-img" value="<?= @$banner['img'] ?>" />
                            <div class="clear-20"></div>
                            <input type="text" id="banner-url" placeholder="链接" value="<?= @$banner['url'] ?>" class="form-control url">
                            <div class="clear-20"></div>
                            <div class="action">
                                <div class="fl">
                                    <span class="btn btn-success fl file-upload-btn" >
                                        上传<input type="file" id="file-upload-1" name="file" />
                                    </span>
                                    <span class="fl file-upload-status" id="file-upload-status-1"></span>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>  
                <div class="clear-20"></div>    


                <div class="clear-20"></div>            
                                                                                        
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button class="btn btn-primary" onclick="save()">保存</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/res/jqueryfileupload/jquery.fileupload.js"></script>
<script type="text/javascript" src="/js/admin/change-index-pic.js"></script>
