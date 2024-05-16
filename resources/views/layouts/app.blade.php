<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="{{ asset('form.css') }}" rel="stylesheet">

</head>
<body>
    <header>
        <a href="{{ route('lang.switch', 'en') }}">English</a>
        <a href="{{ route('lang.switch', 'ar') }}">العربية</a>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('layouts.footer')

    </footer>
    
</body>
</html>
