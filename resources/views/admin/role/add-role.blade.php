@extends('layoutmaster.master_admin')
@section('title')
    <title>AddRole</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <form action="{{ route('permission.store') }}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm role</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                @if (session('msg'))
                                    <div class="alert alert-success">
                                        {{ session('msg') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="name_menu">Tên role</label>
                                    <input type="text" name="name" id="name_menu"
                                        class="form-control @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <div class="alert-sm p-1 alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Nội dung role</label>
                                    <input type="text" name="display" id=""
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

                        
                        <input type="submit" value="Thêm" class="btn btn-success float-left">
                        <!-- /.card -->
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
