@extends('layoutmaster.master_admin')


@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-solid mt-4 mx-4">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-12 col-sm-6">
                                    <div class="col-12">
                                        <img src="{{ asset($products->file_path) }}" class="product-image"
                                            alt="{{ $products->file_name }}">
                                    </div>
                                    <div class="col-12 product-image-thumbs">
                                        <div class="product-image-thumb">
                                            <img src="{{ asset($products->file_path) }}"
                                                alt="{{ $products->file_name }}">
                                        </div>
                                        @foreach ($products->images as $item)
                                            <div class="product-image-thumb">
                                                <img src="{{ asset($item->file_path) }}" alt="{{ $item->file_name }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3">{{ $products->title }}</h3>
                                    <p>{{ $products->content }}
                                    </p>
                                    <hr>
                                    <h4>Status</h4>
                                    <div class="py-2 px-3 mt-2 content-render ">
                                        @include('admin.product.partials-product.details-content-product')
                                    </div>
                                    <h4 class="mt-2">Price</h4>
                                    <div class="py-2 px-3 mt-2">
                                        <h4 class="mb-0 text-danger ">
                                            {{ number_format($products->price) . ' VND' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="error" class="modal fade show" aria-modal="true">
        <div class="modal-dialog modal-confirm-delete">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <img class="mx-auto mt-2" src="{{ asset('admin/csscustom/img/iconerr.png') }}" alt="">
                    </div>
                    <h4 class="modal-title w-100 mt-2 text-center">Sorry!</h4>
                </div>
                <div class="modal-body">
                    <p class='text-center' id="msgerr"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="success" class="modal fade show" aria-modal="true">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xe5ca;</i>
                    </div>
                    <h5 class="modal-title w-100 mt-2 text-center">Success</h5>
                </div>
                <div class="modal-body">
                    <p class="text-center" id="msgsuccess"></p>
                </div>
                <div class="modal-footer">
                    <button id="confEror" class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            });
            $('#approved').on('click', function() {
                const url = $(this).data('url');
                var id = $(this).data('id');
                var data = {
                    'id': id
                };
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
                    success: function(response) {
                        if (response.code === 200) {
                            $('#msgsuccess').text(response.message)
                            $('#success').modal('show');
                            $('.content-render').html(response.renderview);
                        } else if (response.code === 403) {
                            $('#msgerr').text(response.message);
                            $('#error').modal('show');
                        }
                    },
                    err: function(err) {
                        console.log(err);
                    }
                });
            });
        })
    </script>
@endsection
