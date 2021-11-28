@extends('layoutmaster.master_admin')
@section('title')
    <title>Update Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/src/plusign/csss/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-12 mt-4">
                    <form id="form" enctype="multipart/form-data">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Products</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_menu">Title Product</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ $products->title }}">
                                    <span class="error_text text-danger title-error"></span>

                                </div>

                                <div class="form-group">
                                    <label for="">Content Product</label>
                                    <textarea name="content" id="content"
                                        class="form-control">{{ $products->content }} </textarea>
                                    <span class="error_text text-danger content-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Price Product</label>
                                    <div class="input-group">
                                        <input type="text" name="price" id="price" class="form-control"
                                            value="{{ $products->price }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text money-format"></span>
                                        </div>
                                    </div>
                                    <span class="error_text text-danger price-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Category Product</label>
                                    <select name="category" id="category" class="custom-select">
                                        {!! $categoryAll !!}
                                    </select>
                                    <span class="error_text text-danger category-error "></span>
                                </div>

                                <div class="form-group" id="">
                                    <label for="">Feature Images Product</label>
                                    <div class="custom-file">
                                        <input type="file" id="imagefeature" name="imagefeature" class="custom-file-input"
                                            id="customFileLang" lang="es">
                                        <label class="custom-file-label" for="customFileLang">Click để chọn hình ảnh</label>
                                    </div>
                                    <div class="" id="featureview">
                                        <img style="margin: 10px;width: 100px;height: 100px;"
                                            src="{{ asset($products->file_path) }}" alt="{{ $products->file_name }}">
                                    </div>
                                    <span class="error_text text-danger imagefeature-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Additional Pictures Product</label>
                                    <div class="custom-file">
                                        <input multiple type="file" id="imagemutil" name="imagemutil[]"
                                            class="custom-file-input" id="customFileLang" lang="es">
                                        <label class="custom-file-label" for="customFileLang">Click để chọn hình ảnh</label>
                                    </div>
                                    <div id="preview">
                                        @foreach ($products->images as $value)
                                            <img style="margin: 10px;width: 100px;height: 100px;"
                                                src="{{ asset($value->file_path) }}" alt="{{ $value->file_name }}">
                                        @endforeach
                                    </div>
                                    <span class="error_text text-danger imagemutil-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags Product</label>
                                    <select name="tags[]" id="tags" class="form-control" multiple>
                                        @foreach ($products->tags as $value)
                                            <option selected value="{{ $value->name }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error_text text-danger tags-error"></span>
                                </div>

                            </div>

                        </div>
                        <button id="updateproduct" data-url="{{ route('product.update', ['id' => $products->id]) }}"
                            class="btn btn-success float-left">UpdateProduct</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.modal-bootstrap')

@endsection

@section('js')
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/src/js/select2-tags.js') }}"></script>
    <script>
        function previewImages() {

            var $preview = $('#preview').empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                }

                var reader = new FileReader();

                $(reader).on("load", function() {
                    $preview.append(
                        $("<img/>", {
                            src: this.result,
                            style: "margin:10px;width:100px;heigh:100px"
                        }));
                });
                reader.readAsDataURL(file);
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
        $('.money-format').text(formatter.format($('#price').val()));
        $(document).ready(function() {
            $('#imagemutil').on("change", previewImages);
            $('#imagefeature').on("change", featureImage);
            $('#form').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                var url = $('#updateproduct').data('url');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    type: "POST",
                    url,
                    data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('body').find("span.error_text").text('');
                        $('body').find(".is-invalid").removeClass('is-invalid');
                        $('.select2-selection--multiple').css('border-color', '#aaaaaa');
                        $('#updateproduct').attr('disabled', true);

                    },
                    success: function(response) {
                        if (response.code === 200) {
                            $('#updateproduct').removeAttr('disabled');
                            $('#msgsuccess').text(response.message);
                            $('#success').modal('show');
                        } else if (response.code === 404) {
                            $('#updateproduct').removeAttr('disabled');
                            $('#msgerror').text(response.message);
                            $('#error').modal('show');
                        }
                    },
                    error: function(err) {
                        if (err.status === 422) {
                            $('#updateproduct').removeAttr('disabled');
                            var errors = $.parseJSON(err.responseText);
                            $.each(errors.errors, function(indexInArray, valueOfElement) {
                                $('span.' + indexInArray + '-error').text(
                                    valueOfElement[0]);
                                $('#' + indexInArray).addClass('is-invalid');
                                if (indexInArray == 'tags') {
                                    $('.select2-selection--multiple').css(
                                        'border-color', 'red');
                                }
                            });
                        } else if (err.status === 500) {
                            $('#updateproduct').removeAttr('disabled');
                            $('#msgerror').text('Server Fails');
                            $('#error').modal('show');
                        }
                    }
                });
            });

            $('#price').keyup(function() {
                $('.money-format').text(formatter.format($(this).val()));
            });
        });
    </script>
@endsection
