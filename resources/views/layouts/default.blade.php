<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do App | Home')</title>

    <link rel="icon" type="image/png" href="static/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/vendor/bootstrap-5.0-beta-3/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}" />
</head>

<body>
    @include('includes.nav', ['status' => Auth::check()])

    @yield('content')

    @yield('footer')

    <script type="text/javascript" src="{{ asset('static/vendor/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/vendor/bootstrap-5.0-beta-3/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/util.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/main.js') }}"></script>
</body>
</html>
