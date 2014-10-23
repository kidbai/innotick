function save (key) {
    var post_id_list = $("#post").val();
    if (!post_id_list)
    {
        alert("请查看是否没有填写信息");
        return;
    }

    setConfig(key, post_id_list);
}