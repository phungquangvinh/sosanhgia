function AjaxFunction(url, method, data, index_more){
    var content = {
        url: url,
        type: method
    };
    if(data && typeof data == 'object')
        content.data = data;

    if(index_more && typeof index_more == 'object')
        for(var index in index_more){
            if(!content.hasOwnProperty(index)){
                content[index] = index_more[index];
            }
        }
    return $.ajax(content);
}

$(function() {
    $('.js-action-delete').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);

        if(confirm("Bạn có chắc chắn muốn xóa bản ghi này?")) {
            window.location.href = $this.attr('href');
        }
    });
});