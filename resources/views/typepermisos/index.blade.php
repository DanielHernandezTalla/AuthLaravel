@extends('layouts.app')
@section('title', 'Catálogo permisos')

@section('content')

    @include('components.header', [
        'button' => ['name' => 'Agregar permiso', 'url' => 'datos.typepermissions.create'],
    ])

    <div class="section">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <x-tablas.number-pagination />

            <form class="d-flex align-items-center justify-content-end p-0 gap-2"
                action="{{ route('datos.typepermissions.index') }}">
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
                    <th>Id permiso</th>
                    <th>Categoría</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <x-tablas.empty :data="$type_permissions" colspan='5' />
                @foreach ($type_permissions as $type)
                    <tr>
                        <td><a href={{ route('datos.typepermissions.show', $type->id) }}>{{ $type->id }}</a></td>
                        <td>{{ $type->name }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($type->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($type->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>
                            <x-tablas.delete-row id="{{ $type->id }}" route='datos.typepermissions.destroy' />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($type_permissions->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $type_permissions->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif
@endsection
