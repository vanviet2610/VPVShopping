@extends('layoutmaster.master_admin')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('role.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="" class="btn btn-warning ml-2 float-left">Đã xóa</a>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div id="msg" class="alert-sm alert-success p-2 mt-1">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @if (session('msgerr'))
                        <div id="msg" class="alert-sm alert-danger p-2 mt-1">
                            {{ session('msgerr') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách permission</h3>
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
                                            <th scope="row">{{ $permission->firstItem() + $key }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->display_name }}</td>
                                            <td class="project-actions ">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('permission.edit', ['id' => $item->id]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Sửa
                                                </a>
                                                <form style="display: inline;"
                                                    action="{{ route('permission.delete', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit" href="">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Xóa
                                                    </button>
                                                </form>
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
                        {{ $role->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
