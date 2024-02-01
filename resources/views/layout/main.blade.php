<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    @include('layout.header')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                @include('layout.sidebar')
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('js/chart.umd.min.js') }}"></script>

<script src="{{ asset('js/fontawesome.min.js') }}"></script>




@include('layout.footer') 
    
</footer>
</html>