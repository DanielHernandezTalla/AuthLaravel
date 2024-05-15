@extends('layouts.app')
@section('title', 'Nuevo Permiso')
@section('content')

    @include('components.header')

    <div class="section-content">
        <form method="POST" action="{{ route('datos.permisos.store') }}" class="p-0">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id permiso</label>
                    <input type="text" class="form-control" id="id" value="" disabled data-disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre permiso</label>
                    <input type="text" class="form-control" name="name" id="name"
                        placeholder="Escribe el nombre del permiso" value="" autofocus>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button id="form-cancel" type="button" class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>

@endsection
