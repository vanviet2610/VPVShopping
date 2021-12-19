@extends('layoutmaster.master_admin')
@section('title')
    <title>Product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/src/css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/src/css/indexproduct.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/src/css/confirmdeleteYesAndNo.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="mt-2 ml-2">
                    <a href="{{ route('product.create') }}"><i class="fas fa-plus-square fa-success fa-2x "
                            style="color: #22BB33"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách PRODUCTS</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%;padding-left: 0rem">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Image</th>
                                        <th scope="col" style="width: 10%"></th>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                    @include('admin.product.partials-product.view-table-product')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="pagination">
                @include('admin.product.partials-product.view-pagination-product')
            </div>
        </div>
    </div>
    @include('admin.partials.modal-bootstrap')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#deleteProduct', function() {
                var url = $(this).data('url');

                $('#confirmdelete').modal('show');
                $('#btnconfirm').unbind('click');
                $('#btnconfirm').on('click', function() {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url,
                        data: "null",
                        dataType: "json",
                        success: function(res) {
                            if (res.code === 200) {
                                console.log(res.contents);
                                $('#confirmdelete').modal('hide');
                                $('#msgsuccess').text(res.message);
                                $('#success').modal('show');
                                $('#table').html(res.contents);
                                $('#pagination').html(res.pagination);
                            }
                        },
                        error: function(err) {
                            if (err.status === 403) {
                                console.log(err);
                                var parserJsonTextrespone = JSON.parse(err
                                    .responseText);
                                console.log(parserJsonTextrespone);
                                window.location.href = parserJsonTextrespone.url
                            }
                            if (err.status === 500) {
                                $('#msgerror').text('Server Error');
                                $('#error').modal('show');
                            }
                        }
                    });
                });

            });
        });
    </script>
@endsection
