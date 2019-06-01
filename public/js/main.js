function add(id) {
    $.ajax({
       type: "POST",
       url: "?page=cart&func=add&id=" + id,
        success: function (date) {
           let value = JSON.parse(date);
           $('#cart').html(value.count);
           $('#msg').html(value.msg);
        }
    });
}