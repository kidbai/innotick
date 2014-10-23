function save (key) {
    var post_list = $("#post").val();
    if (!post_list)
    {
        alert("请查看是否没有填写信息");
        $("#post").focus();
        return;
    }

    setConfig(key, post_list);
   
            
}