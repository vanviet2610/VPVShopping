@extends('layoutmaster.master_admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/imagetable.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('role.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="{{ route('role.trash') }}" class="btn btn-warning ml-2 float-left">Đã xóa</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách vai trò</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%">#</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th class="pl-4" scope="col">Nội dung</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-role">
                                    @include('admin.role.partials-role.index-table-role')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="quantityRole">
                @include('admin.role.partials-role.view-bottom-quantity')
            </div>
        </div>
    </div>
    {{-- form modal show delete --}}
    <div class="modal fade" id="formdelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông báo
                    </h5>
                </div>
                <div class="modal-body">
                    Bạn có chắc muốn xóa?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy Bỏ</button>
                    <button type="button" id="okConfirm" class="btn btn-primary">Đồng ý xóa</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal success --}}
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
                    <p class="text-center" id="message"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="error" class="modal fade">
        <div class="modal-dialog modal-confirm-delete">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100 mt-2 text-center">Sorry!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center" id="err"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.deleteRole', function(e) {
                const cursor = $(this);
                url = cursor.data('url');
                $('#formdelete').modal('show');
                $('#okConfirm').unbind('click');
                $('#okConfirm').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: () => {
                            $('#formdelete').modal('hide');
                        },
                        success: data => {
                            if (data.code == 200) {
                                $('#message').html(data.message + "!");
                                $('#success').modal('show');
                                $('#table-role').html(data.view);
                                $('#quantityRole').html(data.quantityRole);
                            } else if (data.code == 404) {
                                $('#err').html(data.message + "!");
                                $('#error').modal('show');
                            }
                        },
                        error: (err) => {
                            $('#err').html(err.responseJSON['message'] + ' (Request Fails)');
                            $('#error').modal('show');
                        }
                    });
                });
            });

        });
    </script>
@endsection
