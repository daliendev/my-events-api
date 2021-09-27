<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/bf195a1bde.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href={{ URL::asset('css/app.css'); }}>
        <title>API EVENTS - @yield('title')</title>
    </head>
    <body id="api">
        @yield('grid')
        @yield('info')
    </body>
</html>
