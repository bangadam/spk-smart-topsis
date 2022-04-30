<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Landing Page - Start Bootstrap Theme</title>

        @include('home.layouts.__css')
    </head>
    <body>
        <!-- Navigation-->
        @include('home.layouts.__nav')

        @yield('content')

        <!-- Footer-->
        @include('home.layouts.__footer')

        @include('home.layouts.__js')
    </body>
</html>
