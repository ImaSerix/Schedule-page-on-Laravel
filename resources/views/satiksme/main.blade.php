<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Satiksme</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div id="language-switcher">
                <a class = "{{ app()->getLocale() == 'lv'? 'selected': ' '}}" href="{{ route('lang.switch', 'lv') }}">LV</a>
                <a class = "{{ app()->getLocale() == 'en'? 'selected': ' '}}" href="{{ route('lang.switch', 'en') }}">EN</a>
            </div>
            <div class="profile">
                @auth
                     <p>{{__('messages.hello')}}, {{ Auth::user()->name }}!</p>
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="">
                            {{ __('Logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                    <a href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                @endauth
            </div>
        </div>
    </header>
    <main>
        <div class = "content">
            <h2 class = "content-header">{{__('messages.Daugavpils timetable')}}</h2>
            <nav class="nav">
                <div id = 'tabs'>
                    <button id = 'all' onclick="window.location.href = 'https://ima.zvidris.lv/#all'">{{__('messages.All')}}</button>
                    <button id = 'bus' onclick="window.location.href = 'https://ima.zvidris.lv/#bus'">{{__('messages.bus')}}</button>
                    <button id = 'tram' onclick="window.location.href = 'https://ima.zvidris.lv/#tram'">{{__('messages.tram')}}</button>
                    @auth
                        <button id = 'saved' onclick="window.location.href = 'https://ima.zvidris.lv/#saved'">{{__('messages.saved')}}</button>
                    @endauth
                </div>
            </nav>
            <div class="content">
                <ul id = "content-networks"></li>
            </div>
        </div>
    </main>
    <script src="js/tabController.js"></script>
</body>
</html>