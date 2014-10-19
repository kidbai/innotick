function save (key)
{
    var tag = $('#tag').val();
    if (!tag)
    {
        alert("请检查是否填写完整");
        return false;
    }

    setConfig(key, tag);
            
}