$(document).ready(function () {
    $("#tags").select2({
        placeholder: "Vui lòng nhập tags",
        allowClear: true,
    });
    $("#tags").select2({
        tags: true,
        tokenSeparators: [','],
        theme: "classic",
        width:'100%'
    });
});


