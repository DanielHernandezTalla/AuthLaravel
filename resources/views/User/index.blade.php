@extends('layouts.app')
@section('title', 'Catálogo usuarios')
{{-- @section('headButtons', [['title' => 'Agregar usuario', 'url' => '/user/create']]) --}}
@section('content')

    @include('components.header', [
        'button' => ['name' => 'Agregar usuario', 'url' => 'datos.users.create'],
    ])

    <div class="section">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <x-tablas.number-pagination />
            <form class="d-flex align-items-center justify-content-end p-0 gap-2" action="{{ route('datos.users.index') }}">
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
                    <th>Id Usuario</th>
                    <th>Nombre usuario</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <x-tablas.empty :data="$users" colspan='7' />
                @foreach ($users as $user)
                    <tr>
                        <td><a href={{ route('datos.users.show', $user->id) }}>{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->roles[0]->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><x-tablas.fecha fecha="{{ $user->created_at }}" /> </td>
                        <td><x-tablas.fecha fecha="{{ $user->updated_at }}" /> </td>
                        </td>
                        <td>
                            <x-tablas.delete-row id="{{ $user->id }}" route='datos.users.destroy' />
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($users->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif

@endsection
