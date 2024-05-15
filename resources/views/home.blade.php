@extends('layouts.app')
@section('title', 'Home')

@section('content')

    <div class="bg-white d-flex px-4 py-3 rounded-3">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="w-100">
                <p class="h1 text-center"> Gestor de Servicios Kowi. </p>
                <div class="text-secondary text-center">Gestiona tus aplicaciones desde esta plataforma.</div>
            </div>
        </div>
    </div>

    <div class="section section-1024 bg-transparent d-flex flex-column gap-5">
        <div>
            <p class="fw-bold">SITIOS WEB</p>
            <div class="d-flex flex-wrap">
                <div class="col-12 col-sm-6 col-md-3 py-3 d-flex gap-3 align-items-center">
                    <i class="bi bi-globe h1 m-0 p-0"></i>
                    <p class="m-0 fw-bold text-secondary">Sitio Web</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 py-3 d-flex gap-3 align-items-center">
                    <i class="bi bi-envelope-at h1 m-0 p-0"></i>
                    <p class="m-0 fw-bold text-secondary">Comercio electrónico</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 py-3 d-flex gap-3 align-items-center">
                    <i class="bi bi-browser-chrome h1 m-0 p-0"></i>
                    <p class="m-0 fw-bold text-secondary">eCommerce</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 py-3 d-flex gap-3 align-items-center">
                    <i class="bi bi-bus-front-fill h1 m-0 p-0"></i>
                    <p class="m-0 fw-bold text-secondary">Rutas web</p>
                </div>
            </div>
        </div>
        <div>
            <p class="fw-bold">POSWEB 2</p>
            <div class="d-flex flex-wrap">
                <x-dashboard.menu-item ruta='poswebnew.concentradociudad' text='Reporte de ventas'
                    icono='bi-file-bar-graph' />
                <x-dashboard.menu-item ruta='poswebnew.ventasaempleados' text='Ventas a empleado'
                    icono='bi-file-earmark-medical' />
                <x-dashboard.menu-item ruta='poswebnew.concentradociudad' text='Interfaz de mermas' icono='bi-x-octagon' />
                <x-dashboard.menu-item ruta='poswebnew.concentradociudad' text='Interfaz de creditos' icono='bi-cash' />
                <x-dashboard.menu-item ruta='poswebnew.concentradociudad' text='Sitio Web' icono='bi-globe' />
                <x-dashboard.menu-item ruta='poswebnew.concentradociudad' text='Comercio electrónico'
                    icono='bi-envelope-at' />
            </div>
        </div>
    </div>


@endsection
