@extends('layoutmaster.master_admin')
@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/src/css/indexproduct.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <a href="{{ route('slider.create') }}" class="btn btn-success float-left">Thêm</a>
                    <a href="{{ route('slider.trash') }}" class="btn btn-warning float-left ml-2">Trash</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    @if (session('msg'))
                        <div id="msg" class="alert alert-sm alert-success mt-2">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <div class=" shadow card mt-2">
                        <div class="card-header  bg-primary">
                            <h3 class="card-title">Danh sách Slider</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%">#</th>
                                        <th class="pl-4" scope="col">Tên</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col ">Hình ảnh</th>
                                        <th scope="col ">Hình ảnh</th>
                                        <th scope="col "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <img class="image-list-table table-image" accept="image/*"
                                                    src="{{ asset($item->file_path) }}" alt="{{ $item->file_name }}">
                                            </td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <input type="checkbox" id="state" name="status"
                                                        data-url="{{ route('slider.state', ['id' => $item->id]) }}"
                                                        data-bootstrap-switch data-off-color="danger"
                                                        data-on-color="success">
                                                @else
                                                    <input type="checkbox" id="state" name="status"
                                                        data-url="{{ route('slider.state', ['id' => $item->id]) }}"
                                                        data-bootstrap-switch checked data-off-color="danger"
                                                        data-on-color="success">
                                                @endif


                                            </td>
                                            <td class="  project-actions">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('slider.edit', ['id' => $item->id]) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm ml-1"
                                                    href="{{ route('slider.delete', ['id' => $item->id]) }}">
                                                    <i class="fas fa-trash-alt">
                                                    </i>
                                                    Delete
                                                </a>
                                            </td>
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
                {{ $sliders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script>
        $('input[name="status"]').bootstrapSwitch('state');

        $(document).ready(function() {
            $('input[name="status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                var url = $(this).data('url');
                var data = $(this).serialize();

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "POST",
                    url,
                    data,
                    dataType: "json",
                    success: function(response) {

                    },
                    error: function(error) {}
                });

            });


        });
    </script>

@endsection
