<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>Florida Liquor Depot</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/bootstrap-flat-extras.min.css"/>
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="/css/main.css"/>
        <link rel="stylesheet" href="/css/boot-cart.css"/>

        <script src="/js/jquery-2.1.4.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container">

            @include('flash::message')

            @include('layouts.partials.nav')

            @yield('content')

        </div>

        @yield('scripts')

    </body>
</html>