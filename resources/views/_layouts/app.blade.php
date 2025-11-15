<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>@yield('title', 'HKPDAW_Showbiz')</title>
    <!-- để có thể import bootstrap hoặc tailwind -->
    @stack('styles')
    <!-- css style -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <!-- include header -->
    @include('_layouts.header')

    @yield('content')

    <!-- include footer -->
    @include('_layouts.footer')
    @stack('stylesjs')
</body>

</html>