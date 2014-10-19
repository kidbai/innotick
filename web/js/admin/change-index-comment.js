function save (key) {
    var comment_id_list = $('#comment').val();
    if (!comment_id_list)
    {
        alert("请查看是否没有填写信息");
        $("#comment").focus();
        return;
    }

    setConfig(key, comment_id_list);

    
            
}