@extends('layouts.app')
@section('title', 'Catálogo permisos')

@section('content')

    @include('components.header', [
        'button' => ['name' => 'Agregar permiso', 'url' => 'datos.permisos.create'],
    ])

    <div class="section">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <x-tablas.number-pagination />

            <form class="d-flex align-items-center justify-content-end p-0 gap-2"
                action="{{ route('datos.permisos.index') }}">
                <select class="form-select" name="type">
                    <option value="">Elige una categoría</option>
                    @foreach ($type_permissions as $item)
                        @if ($item->id == $type)
                            <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
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
                    <th>Nombre permiso</th>
                    <th>Categoría</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <x-tablas.empty :data="$permissions" colspan='5' />
                @foreach ($permissions as $permission)
                    <tr>
                        <td><a href={{ route('datos.permisos.show', $permission->id) }}>{{ $permission->id }}</a></td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->type }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($permission->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($permission->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>
                            <x-tablas.delete-row id="{{ $permission->id }}" route='datos.permisos.destroy' />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($permissions->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $permissions->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif
@endsection
