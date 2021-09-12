@extends('layoutmaster.master_admin')
@section('title')
    <title>AddRole</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/role.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <form action="{{ route('role.update', ['id' => $role->id]) }}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm vai trò</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
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
                                <div class="form-group">
                                    <label for="name_menu">Tên vai trò</label>
                                    <input type="text" name="name" value="{{ $role->name }}" id="name_menu"
                                        class="form-control @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <div class="alert-sm p-1 alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Nội dung vai trò</label>
                                    <input type="text" name="display" id="" value="{{ $role->display_name }}"
                                        class="form-control @error('display') is-invalid @enderror">
                                </div>
                                @error('display')
                                    <div class="alert-sm p-1 alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="card card-default color-palette-box">
                            <div class="card-header bg-success">
                                <h3 class="card-title">
                                    <i class="fas fa-tag"></i>
                                    Bảng Phân quyền người dùng
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 25%">Phân Quyền Trang</th>
                                            <th scope="col" style="width: 15%;"></th>
                                            <th scope="col" style="width: 15%;"></th>
                                            <th scope="col" style="width: 15%;"></th>
                                            <th scope="col" style="width: 15%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission as $item)
                                            <tr>
                                                <th scope="row">{{ $item->display_name }}</th>
                                                @foreach ($item->getChildALL as $itemChild)
                                                    <td>
                                                        <input type="checkbox" @if ($rolePermission->contains($itemChild))? checked : ""
                                                        @endif value="{{ $itemChild->id }}"
                                                        name="permission[]" id="">
                                                        <br>
                                                        {{ $itemChild->display_name }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="submit" value="Chỉnh sửa" class="btn btn-success float-left">
                        <!-- /.card -->
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
