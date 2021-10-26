@extends('layoutmaster.master_admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/csscustom/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/deletemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/csscustom/success.css') }}">
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="container emp-profile">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="{{ asset('admin/dist/img/vanviet.jpg') }}" alt="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h5>
                                        {{ Str::upper($users->name) }}
                                    </h5>

                                    <ul style="margin-top: 10%" class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                role="tab" aria-controls="home" aria-selected="true">Thông Tin</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button"
                                    data-url="{{ route('user.dashboard.create', ['id' => $users->id]) }}" id="postRole"
                                    class="btn btn-sm btn-info">Thêm Quyền</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 float-right">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <form id="form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>User Id</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input disabled type="number" value="{{ $users->id }}" name="userID">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Ngày Sinh</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Kshiti Ghelani</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $users->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Số Điện Thoại</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>123 456 7890</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Địa Chỉ</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Web Developer and Designer</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Vai Trò Người Dùng</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- modal form create permission --}}
    <div class="modal fade" id="createView" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm vai trò cho người dùng
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Danh sách vai trò</label> <br>
                            <select name="role[]" id="select2" multiple>
                                @foreach ($roles as $value)
                                    <option class="col-md-10" value="{{ $value->id }}">{{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="error_text text-danger role-error m-2"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy Bỏ</button>
                    <button type="button" id="okConfirm" class="btn btn-primary">Đồng ý xóa</button>
                </div>
            </div>
        </div>
    </div>

    <div id="error" class="modal fade">
        <div class="modal-dialog modal-confirm-delete">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <img class="mx-auto mt-2" src="{{ asset('admin/csscustom/img/iconerr.png') }}" alt="">
                    </div>
                    <h4 class="modal-title w-100 mt-2 text-center">Sorry!</h4>
                </div>
                <div class="modal-body">
                    <p class='text-center' id="err"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="success" class="modal fade show" aria-modal="true">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xe5ca;</i>
                    </div>
                    <h5 class="modal-title w-100 mt-2 text-center">Success</h5>
                </div>
                <div class="modal-body">
                    <p class="text-center" id="message"></p>
                </div>
                <div class="modal-footer">
                    <button id="confEror" class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#postRole').click(function(e) {
                e.preventDefault();
                $('#createView').modal('show');
            });

            $('#okConfirm').click(function(e) {
                e.preventDefault();
                let url = $('#postRole').data('url');
                let data = $('#select2').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url,
                    data,
                    dataType: "json",
                    beforeSend: function() {
                        $('body').find('span.error_text').text('');
                        $('.select2-selection').css('border-color', 'black');
                    },
                    success: function(data) {
                        if (data.code === 412) {
                            $('.select2-selection').css('border-color', 'red');
                            console.log(data.message);
                            $.each(data.message, function(indexInArray, valueOfElement) {
                                $('span.' + indexInArray + '-error').text(
                                    valueOfElement[0]);
                            });
                        } else if (data.code === 200) {
                            $('#createView').modal('hide');
                            $('#message').html(data.message);
                            $('#success').modal('show');
                        } else if (data.code === 404) {
                            $('#createView').modal('hide');
                            $('#err').html(data.message);
                            $('#error').modal('show');
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });

            $("#select2").select2({
                placeholder: "Select a state",
                allowClear: true,
                theme: 'classic',
                width: '100%'
            });
        });
    </script>
@endsection
