@extends('layoutmaster.master_admin')
@section('title')
    <title>MenuTrash</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('menu.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="{{ route('menu.trash') }}" class="btn btn-warning ml-2 float-left">Đã xóa</a>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div class="alert-sm alert-success p-2 mt-1">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách menu đã xóa</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%">#</th>
                                        <th class="pl-4" scope="col" style="width: 30%">Tên</th>
                                        <th scope="col">ID Cha</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->parent_id }}</td>
                                            <td class="project-actions ">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('menu.restore', ['id' => $item->id]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Khôi phục
                                                </a>
                                                <a class="btn btn-danger btn-sm mt-1"
                                                    href="{{ route('menu.forever', ['id' => $item->id]) }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Xóa vĩnh viễn
                                                </a>
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
            <div class="row">
                <div class="col-12 ">
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
