@extends('layoutmaster.master-login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>VPV</b>Shop</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Vui lòng đăng nhập</p>
                <form id="formsubmit">
                    <div class="input-group ">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control "
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="m-1 text-danger  error-text error-email"></span>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <span class="m-1 text-danger error-text error-password "></span>
                    <div class="mb-2"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12float-right">
                                <button id="login" data-url="{{ route('auth.account') }}"
                                    class="btn btn-primary btn-block">Đăng
                                    nhập</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-2 mt-2">
                    <a href="{{ route('register') }}" class="text-center">Đăng ký tài khoản mới?</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#formsubmit').submit(function(e) {
                e.preventDefault();
                var data = new FormData(this);
                var url = $('#login').data('url');
                console.log($('meta[name="csrf-token"]').attr('content'));
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
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function(success) {
                        if (success.code === 200) {
                            location.replace(success.url);
                        }
                    },
                    error: function(err) {
                        if (err) {

                        }
                    }
                });
            });
        });
    </script>
@endsection
