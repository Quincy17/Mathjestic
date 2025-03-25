<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $appset->deskripsi }}">
    <meta name="keywords" content="{{ $appset->deskripsi }}">
    <meta name="author" content="{{ $appset->name }}">
    <title>@yield('title') &mdash; {{ $appset->name }}</title>
    <link href="{{ asset('assets/css/fonts/googlefont-poppins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fonts/googlefont-montserrat.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fonts/googlefont-material-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/darktheme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo.png') }}" />
    @stack('css')
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        @include('layouts.dashboard.sidebar')
        <div class="app-container">
            @include('layouts.dashboard.header')
            <div class="app-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
            <br>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
    @include('sweetalert::alert')
    @stack('js')
</body>

</html>
