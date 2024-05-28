@extends('layouts.app')
@section('title', 'Catálogo roles')

@section('content')

    @include('components.header', ['button' => ['name' => 'Agregar rol', 'url' => 'datos.roles.create']])

    <div class="section">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <x-tablas.number-pagination />

            <form class="d-flex align-items-center justify-content-end p-0 gap-2" action="{{ route('datos.roles.index') }}">
                <div class="col-auto">
                    <input class="form-control" type="text" name="name" id="name" placeholder="Buscar..."
                        value="{{ $name }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id Rol</th>
                    <th>Nombre rol</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <x-tablas.empty :data="$roles" colspan='5' />
                @foreach ($roles as $rol)
                    <tr>
                        <td><a href={{ route('datos.roles.show', $rol->id) }}>{{ $rol->id }}</a></td>
                        <td>{{ $rol->name }}</td>
                        <td><x-tablas.fecha fecha="{{ $rol->created_at }}" /> </td>
                        <td><x-tablas.fecha fecha="{{ $rol->updated_at }}" /> </td>
                        <td>
                            <x-tablas.delete-row id="{{ $rol->id }}" route='datos.roles.destroy' />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($roles->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $roles->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif


@endsection
