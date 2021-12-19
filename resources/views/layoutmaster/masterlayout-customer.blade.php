<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('titlehead')
    <link rel="stylesheet" href="{{ asset('client/plugins/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/plugins/css/animate.css') }}">
    @yield('css')
</head>

<body>
    @include('customer.partials.header-customer')
    @yield('content')
    @include('customer.partials.footer-customer')
    <script src="{{ asset('client/plugins/js/jquery.js') }}"></script>
    <script src="{{ asset('client/plugins/js/bootstrap.min.js') }}"></script>

    @yield('js')
</body>

</html>
