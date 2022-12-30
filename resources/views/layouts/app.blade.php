<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @if(config('view.mode') === 'vite')
        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    @endif

    @if(config('view.mode') === 'webmix')
        <script src="{{ asset('/storage/js/app.js') }}" defer></script>
        <link href="{{ asset('/storage/styles/app.css') }}" rel="stylesheet">
    @endif
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

</head>
<body>
<div id="app">
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
