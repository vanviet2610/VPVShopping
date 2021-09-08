@extends('layoutmaster.master_admin')
@section('title')
    <title>PermissionTrash</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('permission.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="{{ route('permission.trash') }}" class="btn btn-warning ml-2 float-left">Đã xóa</a>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div class="alert-sm alert-success p-2 mt-1">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @if (session('msgerr'))
                        <div class="alert-sm alert-success p-2 mt-1">
                            {{ session('msgerr') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách permission đã xóa</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th scope="col">Thuộc thư mục cha</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permission as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $permission->firstItem() + $key }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->display_name }}</td>
                                            <td>{{ $item->parent_id }}</td>
                                            <td class="project-actions ">
                                                <form style="display: inline;"
                                                    action="{{ route('permission.restore', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Khôi phục
                                                    </button>
                                                </form>
                                                <form style="display: inline;"
                                                    action="{{ route('permission.destroy', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Xóa vĩnh viễn
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class=" float-left card px-4 py-2 ">
                        @if ($permission->total() == 0)
                            Danh sách trống
                        @else
                            danh sách từ
                            {{ $permission->firstItem() }}
                            đến
                            {{ $permission->lastItem() }}
                            có tất cả
                            {{ $permission->total() }}
                        @endif
                    </div>
                    <div class=" float-right">
                        {{ $permission->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
