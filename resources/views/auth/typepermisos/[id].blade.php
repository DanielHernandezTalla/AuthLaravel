@extends('layouts.app')
@section('title', 'Modificar categoría')
@section('content')

    @include('components.header')

    <div class="section-content">
        <button id="btn-habilitar-edicion" class="btn btn-success">Habilitar edición</button>
        <form method="POST" action="{{ route('datos.typepermissions.update', $type_permission->id) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="updateName" value="1">

            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id categoría</label>
                    <input type="text" class="form-control" id="id" value="{{ $type_permission->id }}" disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre categoría</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Escribe el nombre de la categoría" value="{{ old('name') ?? $type_permission->name }}"
                        disabled data-undisabled>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="created" class="form-label">Creado en</label>
                    <input type="text" id="created" class="form-control" placeholder="First name"
                        aria-label="First name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($type_permission->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
                        disabled>
                </div>
                <div class="col">
                    <label for="updated" class="form-label">Actualizado en</label>
                    <input type="text" id="updated" class="form-control" placeholder="Last name" aria-label="Last name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($type_permission->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
                        disabled>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button type="button" class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success" disabled data-undisabled>Enviar</button>
                </div>
            </div>
        </form>
    </div>

@endsection
