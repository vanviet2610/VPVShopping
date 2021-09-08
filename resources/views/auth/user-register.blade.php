@extends('layoutmaster.master-login')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href=""><b>VPV</b>Shop</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Đăng ký tài khoản mới </p>
                @if (session('msg'))
                    <div class="alert alert-sm alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                <form action="{{ route('auth.regis') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid  @enderror" placeholder="Nhập tên">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <div class="alert alert-sm alert-danger p-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input value="{{ old('email') }}" type="email" name="email"
                            class="form-control @error('email')
                            is-invalid
                        @enderror"
                            placeholder="Vui lòng nhập email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="alert alert-sm alert-danger p-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('password')
                            is-invalid
                        @enderror"
                            placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="alert alert-sm alert-danger p-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirm"
                            class="form-control @error('password_confirm')
                            is-invalid
                        @enderror"
                            placeholder="Nhập lại mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirm')
                        <div class="alert alert-sm alert-danger p-1">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-12">
                            <div class="col-4 float-right">
                                <button type="submit" class="btn btn-primary btn-block mb-2">Đăng ký</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-center">Tôi đã có tài khoản!</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection
