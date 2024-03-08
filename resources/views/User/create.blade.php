@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('content')

    @include('components.header')

    <div class="section-content">
        <form action="" class="p-0">
            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id usuario</label>
                    <input type="text" class="form-control" id="id" value="" disabled data-disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="name" placeholder="Escribe el nombre completo"
                        value="">
                </div>
            </div>
            <div class="mb-3">
                <label for="Rol" class="form-label">Rol</label>
                <input type="text" class="form-control" id="rol" placeholder="Selecciona un rol" value="">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" placeholder="Escribe tu correo" value="">
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="email" class="form-label">Creado en</label>
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name" disabled
                        data-disabled>
                </div>
                <div class="col">
                    <label for="email" class="form-label">Actualizado en</label>
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" disabled
                        data-disabled>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>

@endsection
