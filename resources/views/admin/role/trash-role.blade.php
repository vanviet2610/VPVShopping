@extends('layoutmaster.master_admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/role.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('role.create') }}" class="btn btn-success float-left">Thêm</a>
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
                            <h3 class="card-title">Danh sách đã xóa role</h3>
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
                                                <button type="button" id="btnrestore"
                                                    data-url="{{ route('role.restore', ['id' => $item->id]) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-trash-restore">
                                                    </i>
                                                    Phục hồi
                                                </button>
                                                <button type="button"
                                                    data-url="{{ route('role.destroy', ['id' => $item->id]) }}"
                                                    class="btn btn-danger btn-sm mt-1" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Xóa vĩnh viễn
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class=" float-left card px-4 py-2 ">
                        @if ($role->total() == 0)
                            Danh sách trống
                        @else
                            danh sách từ
                            {{ $role->firstItem() }}
                            đến
                            {{ $role->lastItem() }}
                            có tất cả
                            {{ $role->total() }}
                        @endif
                    </div>
                    <div class=" float-right">
                        {{ $role->onEachSide(1)->links() }}
                    </div>

                </div>
            </div>
            {{-- modal Restore --}}
            <div class="modal fade" id="modalRestore" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông báo
                            </h5>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc muốn khôi phục?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy Bỏ</button>
                            <button type="button" id="okConfirmRestore" class="btn btn-primary">Đồng ý
                                khôi phục</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal delete destroy --}}
            <div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thông báo
                            </h5>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc muốn xóa vĩnh viễn?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy Bỏ</button>
                            <button type="button" id="okConfirmDestroy" class="btn btn-primary">Đồng ý
                                xóa</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- success modal --}}
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
                    <p>Chúc mừng bạn đã Xóa thành công nhé !!!!!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            $('body').on('click', '#btnrestore', function() {
                let cursor = $(this);
                let url = cursor.data('url');
                $('#modalRestore').modal('show');
                $('#okConfirmRestore').unbind('click');
                $('#okConfirmRestore').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: () => {
                            $('#modalRestore').modal('hide');
                            $('#success').modal('show');
                        },
                        success: function(data) {
                            if (data.code == 200) {
                                $('#success').modal('hide');
                                window.location.reload();
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
