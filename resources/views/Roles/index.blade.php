@extends('layouts.app')
@section('title', 'Catálogo roles')

@section('content')

    @include('components.header', ['button' => ['name' => 'Agregar rol', 'url' => 'datos.roles.create']])

    <div class="section">
        <h4>Listado de usuarios</h4>
        <table>
            <thead>
                <tr>
                    <th>Id Rol</th>
                    <th>Nombre rol</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $rol)
                    <tr>
                        <td><a href={{ route('datos.roles.show', $rol->id) }}>{{ $rol->id }}</a></td>
                        <td>{{ $rol->name }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($rol->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($rol->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($roles->withQueryString()->lastPage() != 1)
        <div class="section">
            {!! $roles->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif


@endsection
