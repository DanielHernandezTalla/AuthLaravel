@extends('layouts.app')
@section('title', 'Datos')
@section('content')

    @include('components.header')

    <div class="section section-1024">
        {{-- <h4>Listado de usuarios</h4> --}}

        <div class="row g-3">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="datos-item">
                    <a href="{{ route('datos.users.index') }}">
                        <i class="bi bi-people-fill"></i>
                        <h6>Usuarios</h6>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="datos-item">
                    <a href="{{ route('datos.roles.index') }}">
                        <i class="bi bi-ui-checks-grid"></i>
                        <h6>Roles</h6>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="datos-item">
                    <a href="{{ route('datos.permissions.index') }}">
                        <i class="bi bi-person-fill-slash"></i>
                        <h6>Permisos</h6>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="datos-item">
                    <a href="{{ route('datos.typepermissions.index') }}">
                        <i class="bi bi-list-ul"></i>
                        <h6>Categoría Permisos</h6>
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection
