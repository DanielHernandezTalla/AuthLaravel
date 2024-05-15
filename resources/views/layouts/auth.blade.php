<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title') </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Local styles --}}
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/tables.css">
</head>

<body>
    <div id="app" class="bg-slate-100 d-flex justify-content-start" style="height: 100vh">

        <main class="main-auth d-flex flex-column justify-content-center gap-4 p-4">
            @yield('content')
        </main>

    </div>

    <script src="/app/index.js"></script>
</body>

</html>
