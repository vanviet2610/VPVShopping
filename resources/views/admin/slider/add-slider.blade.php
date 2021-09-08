@extends('layoutmaster.master_admin')
@section('title')
    <title>AddSlider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/imagetable.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <form action="{{ route('slider.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm Slider</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            @if (session('msg'))
                                <div class="alert alert-sm alert-success -p-2">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            @if (session('msgerr'))
                                <div class="alert alert-sm alert-danger -p-2">
                                    {{ session('msgerr') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên Slider</label>
                                    <input
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        type="text" id="name" name="name" class="form-control">
                                </div>
                                @error('name')
                                    <div class="alert alert-sm alert-danger p-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Nội dung slider</label>
                                    <textarea name="description"
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                @error('description')
                                    <div class="alert alert-sm alert-danger p-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <input accept="image/*" type="file" onchange="loadFile(event)"
                                        class="form-control-file @error('image')
                                        is-invalid
                                    @enderror"
                                        name="image" id="">
                                    <img id="output" class="image-add-form mt-1"
                                        src="{{ asset('admin/dist/img/addImage.png') }}" alt="">
                                </div>
                                @error('image')
                                    <div class="alert alert-sm alert-danger p-2">
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
@section('js')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
