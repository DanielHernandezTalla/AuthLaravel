@extends('layouts.auth')

@section('content')
    <div class="unautorize-content ">
        <div class="d-flex justify-content-center align-items-center flex-wrap flex-lg-nowrap gap-4">
            <div>
                <span>404 error</span>
                <h1>Pagina no encontrada</h1>
                <p class="text-secondary">Es posible que haya escrito mal la dirección o que la página se haya movido</p>
                <div class="pt-2">
                    @guest
                        <a href="/" class="btn btn-orange">Ir al inicio de sesión</a>
                    @else
                        <a href="/" class="btn btn-orange">Ir al inicio</a>
                    @endguest
                </div>
            </div>
            <div>
                <img class="img-403" src="/images/404.svg" alt="404">
            </div>
        </div>
    </div>
@endsection
