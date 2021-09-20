@extends('layoutmaster.master_admin')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="" class="btn btn-success float-left">Thêm</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div id="msg" class="alert alert-sm alert-success mt-2">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @if (session('msg'))
                        <div id="msg" class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif

                    @if (session('msgerr'))
                        <div id="msgerr" class="alert alert-danger">
                            {{ session('msgerr') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách category đã xóa</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th scope="col">Thuộc thư mục cha</th>
                                        <th scope="col ">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->parent_id }}</td>
                                            <td class="  project-actions">
                                                <form style="display: inline"
                                                    action="{{ route('category.restore', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-info btn-sm" href="">
                                                        <i class="fas fa-trash-restore">
                                                        </i>
                                                        Phục hồi
                                                    </button>
                                                </form>
                                                <form style="display: inline"
                                                    action="{{ route('category.forever', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm ">
                                                        <i class="fas fa-trash-alt">
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
