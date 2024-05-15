@extends('layouts.app')
@section('title', 'Catálogo usuarios')
{{-- @section('headButtons', [['title' => 'Agregar usuario', 'url' => '/user/create']]) --}}
@section('content')

    @include('components.header', [
        'button' => ['name' => 'Agregar usuario', 'url' => 'datos.user.create'],
    ])

    <div class="section">
        <div class="d-flex mb-2">
            <x-tablas.number-pagination />
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
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href={{ route('datos.user.show', $user->id) }}>{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->roles[0]->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
                        </td>
                        <td>{{ ucfirst(\Carbon\Carbon::parse($user->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}
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
