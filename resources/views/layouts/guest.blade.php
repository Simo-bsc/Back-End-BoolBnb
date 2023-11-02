<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title')</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>

    <body class="bglog">

        <div class=" layover">
            <header class="vw-100 position-sticky ">
                @include('partials.header')
            </header>
    
            <main>
                @yield('main-content')
            </main>
    
            <footer>
                @include('partials.footer')
            </footer>
        </div>
        
    </body>
</html>
