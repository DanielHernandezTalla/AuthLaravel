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

    {{-- Datatables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Local styles --}}
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/tables.css">
</head>

<body>
    <div id="app" class="bg-slate-100 d-flex justify-content-start" style="height: 100vh">

        <x-dashboard.alerts />

        <nav class="nav d-flex flex-column justify-content-between"
            style="min-width:70px; background-color: var(--teal-900)">
            <div class="d-flex flex-column justify-content-between h-100  pt-5 pb-5">
                <button class="position-absolute btn-show-nav"><i class="bi bi-chevron-double-right"></i></button>
                <ul class="d-flex flex-column align-items-center gap-3 p-0 m-0">
                    <li>
                        <a href="/home" title="Dashboard" data-nav><i class="bi bi-speedometer"></i></a>
                    </li>
                    @if (Auth::user()->roles()->first()->name === 'admin')
                        {{-- <li>
                            <a href="/user" title="Usuarios" data-nav><i class="bi bi-database-fill"></i></a>
                        </li> --}}
                        <li>
                            <a href="#" title="Graficas" data-nav><i class="bi bi-bar-chart-fill"></i></a>
                        </li>
                        <li>
                            <a href="/usuarios" title="Usuarios" data-nav><i class="bi bi-person-fill"></i></a>
                        </li>
                        <li>
                            <a href="#" title="Información" data-nav><i
                                    class="bi bi-question-circle-fill"></i></a>
                        </li>
                        <li>
                            <a href="#" title="Configuración" data-nav><i class="bi bi-gear-fill"></i></a>
                        </li>
                    @endif
                </ul>
                <ul class="d-flex flex-column align-items-center p-0 m-0">
                    <li>
                        <p class="nav-user m-0">{{ substr(Auth::user()->name, 0, 1) }}</p>
                    </li>
                    <li>
                        <hr>
                        <a class="text-white fs-4" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <div class="d-flex flex-column justify-content-between h-100 nav-absolute nav-absolute-show pt-5 pb-5">
                <button class="position-absolute btn-show-nav"><i class="bi bi-chevron-double-left"></i></button>
                <ul class="d-flex flex-column align-items-start gap-3 p-0 m-0">
                    <li>
                        <a href="/home" title="Dashboard" data-nav-abs>Dashboard</a>
                    </li>
                    @if (Auth::user()->roles()->first()->name === 'admin')
                        {{-- <li>
                            <a href="/user" title="Usuarios" data-nav-abs>Usuarios</a>
                        </li> --}}
                        <li>
                            <a href="#" title="Graficas" data-nav-abs>Graficas</a>
                        </li>
                        <li>
                            <a href="/usuarios" title="Usuarios" data-nav-abs>Usuarios</a>
                        </li>
                        <li>
                            <a href="#" title="Información" data-nav-abs>Información</a>
                        </li>
                        <li>
                            <a href="#" title="Configuración" data-nav-abs>Configuración </a>
                        </li>
                    @endif
                </ul>
                <ul class="d-flex flex-column align-items-center p-0 m-0 ">
                    <li>
                        <p class="nav-user m-0">
                            <span>{{ Auth::user()->name }}</span>
                            <br>
                            <span>{{ Auth::user()->email }}</span>
                        </p>
                    </li>
                    <li>
                        <hr>
                        <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- @dump(Auth::user()) --}}

        <main class="main main-nav d-flex flex-column gap-4 p-4">
            @yield('content')
        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="/app/index.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', e => {
            new DataTable('#tabla', {
                responsive: true,
                autoWidth: false,
                'language': {
                    'lengthMenu': "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "loadingRecords": "Cargando...",
                    'info': "Mostrando la página _PAGE_ de _PAGES_",
                    'infoEmpty': "Mostrando la página _PAGE_ de _PAGES_",
                    'infoFiltered': "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar:',
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Todos']
                ],
            });
        })
    </script>
</body>

</html>
