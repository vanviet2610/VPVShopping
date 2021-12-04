@extends('layoutmaster.master_admin')
@section('title')
    <title>AddProduct</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <form id="form" enctype="multipart/form-data">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Products</h3>
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
                                    <input placeholder="Tiêu đề sản phẩm" type="text" name="title" id="title"
                                        class="form-control">
                                    <span class="error_text text-danger title-error"></span>

                                </div>

                                <div class="form-group">
                                    <label for="">Content Product</label>
                                    <textarea placeholder="Nội dung sản phẩm" name="content" id="content"
                                        class="form-control"></textarea>
                                    <span class="error_text text-danger content-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Price Product</label>
                                    <div class="input-group">
                                        <input placeholder="Giá sản phẩm" type="text" name="price" id="price"
                                            class="form-control" value="">
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
                                    </div>
                                    <span class="error_text text-danger imagemutil-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags Product</label>
                                    <select name="tags[]" id="tags" class="form-control" multiple>
                                    </select>
                                    <span class="error_text text-danger tags-error"></span>
                                </div>

                            </div>

                        </div>
                        <button id="addproduct" data-url="{{ route('product.store') }}"
                            class="btn btn-success float-left">CreateProduct</button>
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
    <script src="{{ asset('admin/src/js/productadmin/product-add.js') }}"></script>

@endsection
