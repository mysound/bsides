<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
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
                    <h3>Интернет-магазин</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">О нас</a></li>
                    </ul>
                </div>
                <div class="footer-flex-mm">
                    <h3>Помощь покупателю</h3>
                    <ul>
                        <li><a href="{{ route('policy') }}">Правила продажи</a></li>
                        <li><a href="{{ route('payment') }}">Оплата</a></li>
                        <li><a href="{{ route('delivery') }}">Доставка</a></li>
                    </ul>
                </div>
                <div class="footer-flex-mm">
                    <h3>Отзывы</h3>
                    <ul>
                        <li>Social</li>
                    </ul>
                </div>  
            </div>
            <div class="footer-line"></div>
            <div class="footer-cpr">
                <p>Copyright © 2015-{{ now()->year }} B-Sides. Все права защищены. Указанная стоимость товаров и условия их приобретения действительны по состоянию на текущую дату. </p><p>Сайт предназначен для лиц, достигших 18 лет.</p>
            </div>
        </footer>
    </div>
    @yield('script')
</body>
</html>
