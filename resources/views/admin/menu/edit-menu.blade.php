@extends('layoutmaster.master_admin')

@section('title')
    <title>EditMenu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <form action="{{ route('menu.update', ['id' => $menus->id]) }}" method="post">
                        @csrf
                        <div class="shadow card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chỉnh sửa menu</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                @if (session('msg'))
                                    <div class="form-group">
                                        <div class="alert-sm alert-success p-2">
                                            {{ session('msg') }}
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="name_menu">Tên menu</label>
                                    <input value="{{ $menus->name }}" name="name" type="text" id="name_menu"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="parent_id">Thuộc menu</label>
                                    <select name="parent_id" id="parent_id" class="form-control custom-select">
                                        <option value="0">menu cha</option>
                                        {!! $options !!}
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <input type="submit" value="Sửa" class="btn btn-success float-left">
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
