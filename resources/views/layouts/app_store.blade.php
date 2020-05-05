<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'B-Sides') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
    <div id="grid-page">
        @include('layouts.header_store')
        @yield('content')
        <footer>
            <div class="footer-flex">
                <div class="footer-flex-mm">
                    <h3>Store</h3>
                    <ul>
                        <li>Store</li>
                        <li>Store1</li>
                        <li>Store2</li>
                    </ul>
                </div>
                <div class="footer-flex-mm">
                    <h3>FAQ</h3>
                    <ul>
                        <li>FAQ</li>
                        <li>FAQ1</li>
                        <li>FAQ2</li>
                    </ul>
                </div>
                <div class="footer-flex-mm">
                    <h3>Social</h3>
                    <ul>
                        <li>Social</li>
                    </ul>
                </div>  
            </div>
            <div class="footer-line"></div>
            <div class="footer-cpr">
                <p>Copyright © 2015-2020</p>
            </div>
        </footer>
    </div>
    @yield('script')
</body>
</html>
