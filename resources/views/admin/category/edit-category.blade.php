@extends('layoutmaster.master_admin')
@section('title')
    <title>EditCategory</title>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Sửa Category</h3>

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
                                    <label for="name">Tên Category</label>
                                    <input value="{{ $category->name }}" type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <div class="alert-sm p-1 alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="parent_id">Thuộc category cha</label>
                                    <select name="parent_id" id="parent_id" class="form-control custom-select">
                                        <option value="0">Category cha</option>
                                        {!! $stringOptions !!}
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <input type="submit" value="sửa" class="btn btn-success float-left">
                        <!-- /.card -->
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
