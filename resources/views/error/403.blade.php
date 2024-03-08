@extends('layouts.app')

@section('content')
    <div class="unautorize-content d-flex justify-content-center align-items-center">
        <div class="pe-5">
            <span>403 error</span>
            <h1>Acceso denegado </h1>
            <p class="text-secondary">La página a la que intentabas acceder está prohibida por alguna razón</p>
            <div class="pt-2">
                <a href="/" class="btn btn-orange">Ir al inicio</a>
            </div>
        </div>
        <div class="">
            <img class="img-403" src="/images/403.png" alt="403">
        </div>
    </div>
@endsection
