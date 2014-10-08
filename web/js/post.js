function like(post_id)
{
    $.ajax({
        url: '/post/action-save',
        type: 'POST',
        dataType: 'json',
        data: { post_id: post_id, type: 1, '_csrf': global.csrfToken },
        success: function(data)
        {
            
        }
    });    
}

function dislike(post_id)
{
    $.ajax({
        url: '/post/action-save',
        type: 'POST',
        dataType: 'json',
        data: { post_id: post_id, type: 2, '_csrf': global.csrfToken },
        success: function(data)
        {
            
        }
    });    
}