@extends('layouts.app')
@section('title', 'Modificar Permisos')
@section('content')

    @include('components.header')

    <div class="section-content">
        {{-- <button id="btn-habilitar-edicion" class="btn btn-success">Habilitar edición</button> --}}
        <form method="POST" action="{{ route('datos.user.update', $permission->id) }}" class="p-0">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id usuario</label>
                    <input type="text" class="form-control" id="id" value="{{ $permission->id }}" disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') ?? $permission->name }}" disabled data-undisabled>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="created" class="form-label">Creado en</label>
                    <input type="text" id="created" class="form-control" placeholder="First name"
                        aria-label="First name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($permission->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
                        disabled>
                </div>
                <div class="col">
                    <label for="updated" class="form-label">Actualizado en</label>
                    <input type="text" id="updated" class="form-control" placeholder="Last name" aria-label="Last name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($permission->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
                        disabled>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success" disabled data-undisabled>Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="section">
        <h4>Listado de roles que tienen el permiso</h4>
        {{-- <button class="btn btn-outline">Agregar Rol</button> --}}
        <table id="tabla">
            <thead>
                <tr>
                    <th>Id Rol</th>
                    <th>Nombre rol</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @if (count($permission->roles) === 0)
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron resultados</td>
                    </tr>
                @endif
                @foreach ($permission->roles as $role)
                    <tr>
                        <td><a href={{ route('datos.roles.show', $role->id) }}>{{ $role->id }}</a></td>
                        <td>{{ $role->name }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($role->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($role->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
