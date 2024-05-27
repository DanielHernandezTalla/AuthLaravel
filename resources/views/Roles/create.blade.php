@extends('layouts.app')
@section('title', 'Crear rol')
@section('content')

    @include('components.header')

    {{-- <div class="overflow-scroll d-flex flex-column flex-lg-row gap-4"> --}}
    <div class="section-content">
        <form method="POST" action="{{ route('datos.roles.store') }}">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id usuario</label>
                    <input type="text" class="form-control" id="id" placeholder="id" disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre del rol</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Nombre del rol">
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="created" class="form-label">Creado en</label>
                    <input type="text" id="created" class="form-control" placeholder="Fecha de creación" disabled>
                </div>
                <div class="col">
                    <label for="updated" class="form-label">Actualizado en</label>
                    <input type="text" id="updated" class="form-control" placeholder="Fecha de actualización" disabled>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button type="button" class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}

@endsection
