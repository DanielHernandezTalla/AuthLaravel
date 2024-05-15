@extends('layouts.app')
@section('title', 'Catálogo permisos')

@section('content')

    @include('components.header', [
        'button' => ['name' => 'Agregar permiso', 'url' => 'datos.permisos.create'],
    ])

    <div class="section">
        <h4>Listado de permisos</h4>
        <table id="tabla">
            <thead>
                <tr>
                    <th>Id permiso</th>
                    <th>Nombre permiso</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td><a href={{ route('datos.permisos.show', $permission->id) }}>{{ $permission->id }}</a></td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($permission->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($permission->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
