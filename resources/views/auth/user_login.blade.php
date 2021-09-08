@extends('layoutmaster.master-login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>VPV</b>Shop</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Vui lòng đăng nhập</p>
                <form action="{{ route('auth.account') }}" method="post">

                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email')
                            is-invalid
                        @enderror"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="alert alert-sm alert-danger p-2">
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
                        <div class="alert alert-sm alert-danger p-2">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12float-right">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                @if (session('msg'))
                    <div class="row ">
                        <div class="alert alert-danger alert-sm p-2 mt-1 col-12 text-center">
                            {{ session('msg') }}
                        </div>
                    </div>
                @endif
                <p class="mb-2 mt-2">
                    <a href="{{ route('register') }}" class="text-center">Đăng ký tài khoản mới?</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
