@extends('layouts.app')
@section('title', 'Modificar Permisos')
@section('content')

    @include('components.header')

    <div class="overflow-scroll d-flex flex-column flex-lg-row gap-4">
        <div class="section-content">
            <button id="btn-habilitar-edicion" class="btn btn-success">Habilitar edición</button>
            <form method="POST" action="{{ route('datos.permisos.update', $permission->id) }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="updateName" value="1">

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
                        <input type="text" id="updated" class="form-control" placeholder="Last name"
                            aria-label="Last name"
                            value="{{ ucfirst(\Carbon\Carbon::parse($permission->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
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

        <div class="w-100 d-flex flex-column gap-4">
            <div class="section">
                <div class="d-flex flex-column align-items-end gap-3">
                    <form method="POST" action="{{ route('datos.permisos.update', $permission->id) }}"
                        class="p-0 w-100 d-flex mb-3">
                        @csrf
                        @method('PUT')
                        <input class="input-article form-control" list="rols" name="rol" id="rol"
                            placeholder="Agregar rol" autocomplete="off" onkeypress="return event.keyCode != 13;" autofocus>
                        <datalist id="rols">
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">
                                    {{ $rol->name }}</option>
                            @endforeach
                        </datalist>
                        <button type="submit" class="btn btn-outline text-nowrap">Agregar roles</button>
                    </form>
                </div>

                <div class="d-flex mb-2">
                    <x-tablas.number-pagination />
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
                        <x-tablas.empty :data="$rolespermisos" colspan='5' />
                        @foreach ($rolespermisos as $role)
                            <tr>
                                <td><a href={{ route('datos.roles.show', $role->id) }}>{{ $role->id }}</a></td>
                                <td>{{ $role->name }}</td>
                                <td><x-tablas.fecha fecha="{{ $role->created_at }}" /> </td>
                                <td><x-tablas.fecha fecha="{{ $role->updated_at }}" /> </td>
                                <td>
                                    <x-tablas.delete-row id="{{ $role->id }}" route='datos.destroyPermissions'
                                        :values="[['permission' => $permission->id]]" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($rolespermisos->withQueryString()->lastPage() != 1)
                <div class="section-min">
                    {!! $rolespermisos->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            @endif
        </div>
    </div>

@endsection
