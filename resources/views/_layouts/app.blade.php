<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <title>@yield('title', 'HKPDAW_Showbiz')</title>
</head>

<body>
    <!-- include header -->
    @include('_layouts.header')


    @yield('content')

    <!-- include footer -->
    @include('_layouts.footer')
</body>

</html>