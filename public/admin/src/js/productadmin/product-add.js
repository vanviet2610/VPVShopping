function previewImages() {
    var $preview = $('#preview').empty();
    if (this.files) $.each(this.files, readAndPreview);
    function readAndPreview(i, file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        }
        $preview.append(
            $("<img/>", {
                src: URL.createObjectURL(file),
                style: "margin:10px;width:100px;heigh:100px"
            }
            ));
    }

}
function featureImage() {
    $("#featureview").empty();
    $('#featureview').append($("<img/>", {
        src: URL.createObjectURL(this.files[0]),
        style: "margin:10px;width:100px;heigh:100px"
    }));

}
var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 2
});
$(document).ready(function () {
    $('#imagemutil').on("change", previewImages);
    $('#imagefeature').on("change", featureImage);

    $('#form').submit(function (e) {
        e.preventDefault();
        var data = new FormData(this);
        const url = $('#addproduct').data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url,
            data,
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('body').find("span.error_text").text('');
                $('body').find(".is-invalid").removeClass('is-invalid');
                $('.select2-selection--multiple').css('border-color', '#aaaaaa');
                $('#addproduct').attr('disabled', true);
            },
            success: function (res) {
                $('#addproduct').removeAttr('disabled');
                if (res.code === 200) {
                    $('#msgsuccess').text(res.message);
                    $('#success').modal('show');
                } else if (res.code === 404) {
                    $('#error').text(res.message);
                    $('#error').modal('show');
                }

            },
            error: function (err) {
                if (err.status === 422) {
                    $('#addproduct').removeAttr('disabled');
                    var error = JSON.parse(err.responseText)
                    $.each(error.errors, function (index, value) {
                        $('span.' + index + '-error').text(value[0]);
                        $('#' + index).addClass('is-invalid');
                        if (index == 'tags') {
                            $('.select2-selection--multiple').css('border-color', 'red');
                        }
                    });
                }
                if (err.status === 500) {
                    $('#addproduct').removeAttr('disabled');
                    $('#error').text('Server Error');
                    $('#error').modal('show');
                }
            }
        });
    });
    $('#price').keyup(function () {
        $('.money-format').text(formatter.format($(this).val()));
    });
});