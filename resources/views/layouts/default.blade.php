<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App | {{ Str::ucfirst($title ?? 'Home') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('static/img/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/vendor/bootstrap-5.0-beta-3/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}" />
</head>

<body>
    @include('includes.nav')

    @if (session()->has('status'))
        <div class="container">
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show m-3" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @yield('content')

    @yield('footer')

    <script type="text/javascript" src="{{ asset('static/vendor/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/vendor/bootstrap-5.0-beta-3/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/util.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/js/main.js') }}"></script>

    {{-- all additional scripts (if any) will be loaded after the core js files --}}
    @stack('scripts')
</body>
</html>
