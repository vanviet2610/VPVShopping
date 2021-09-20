@extends('layoutmaster.master_admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/imagetable.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/role.css') }}">
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
            <div class="row ">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div id="msg" class="alert alert-success mt-1">
                            {{ session('msg') }}
                        </div>
                    @endif

                    @if (session('msgerr'))
                        <div id="msgerr" class="alert alert-danger mt-1">
                            {{ session('msgerr') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách vai trò</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%">#</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th class="pl-4" scope="col">Nội dung</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $role->firstItem() + $key }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->display_name }}</td>
                                            <td class="project-actions ">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('role.edit', ['id' => $item->id]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Sửa
                                                </a>

                                                <button class="btn btn-danger btn-sm deleteRole"
                                                    data-url="{{ route('role.delete', ['id' => $item->id]) }}"
                                                    type="button">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Xóa
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class=" float-right">
                        {{ $role->onEachSide(1)->links() }}
                    </div>
                </div>
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
                        <i class="material-icons"></i>
                    </div>
                    <h5 class="modal-title w-100 mt-2 text-center">Khôi Phục Thành Công!</h5>
                </div>
                <div class="modal-body">
                    <p>Chúc mừng bạn đã khôi phục thành công nhé !!!!!</p>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Xóa Thành công</h5>
                </div>
                <div class="modal-body text-center">
                    <img class="image-success  mx-auto" src="{{ asset('images/success.png') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.deleteRole', function(e) {
                const cursor = $(this);
                url = cursor.data('url');
                $('#formdelete').modal('show');
                $('#okConfirm').unbind('click');
                $('#okConfirm').click(function() {
                    $.ajax({
                        type: "POST",
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: () => {
                            console.log(url);
                            $('#formdelete').modal('hide');
                            $('#success').modal('show');
                        },
                        success: data => {
                            if (data.code == 200) {
                                $('#success').modal('hide');
                                window.location.reload();
                            }
                        },
                        error: err => {
                            console.log(err);
                        }
                    });
                });
            });

        });
    </script>
@endsection
