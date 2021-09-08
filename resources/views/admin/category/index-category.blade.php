@extends('layoutmaster.master_admin')
@section('title')
    <title>ListCategory</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('category.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="{{ route('category.trash') }}" class="btn btn-warning ml-2 float-left">Đã xóa</a>
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
                            <h3 class="card-title">Danh sách category</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%">#</th>
                                        <th class="pl-4" scope="col" style="width: 30%">Tên</th>
                                        <th scope="col">ID Cha</th>
                                        <th scope="col" style="width: 20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $category->firstItem() + $key }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->parent_id }}</td>
                                            <td class="project-actions ">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('category.edit', ['id' => $item->id]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Sửa
                                                </a>

                                                <form style="display: inline;"
                                                    action="{{ route('category.delete', ['id' => $item->id]) }}"
                                                    method="post">
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
                        @if ($category->total() == 0)
                            Danh sách trống
                        @else
                            danh sách từ
                            {{ $category->firstItem() }}
                            đến
                            {{ $category->lastItem() }}
                            có tất cả
                            {{ $category->total() }}
                        @endif
                    </div>
                    <div class=" float-right">
                        {{ $category->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
