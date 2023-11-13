<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('frontend.partials.styles')
    <title>@yield('title', 'Home')</title>
</head>

<body class="bg-gray-100">
    @include('frontend.partials.header')

    @yield('main')

    @include('frontend.partials.footer')


  
</body>

</html>
