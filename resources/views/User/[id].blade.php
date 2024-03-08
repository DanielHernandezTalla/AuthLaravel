@extends('layouts.app')
@section('title', 'Modificar Usuario')
@section('content')

    @include('components.header')

    <div class="section-content">
        <button id="btn-habilitar-edicion" class="btn btn-success">Habilitar edición</button>
        <form method="POST" action="{{ route('datos.user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id usuario</label>
                    <input type="text" class="form-control" id="id" value="{{ $user->id }}" disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') ?? $user->name }}" disabled data-undisabled>
                </div>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select id="rol" class="form-select" name="idRol" disabled data-undisabled>
                    <option value="">Elige un rol</option>
                    @foreach ($roles as $rol)
                        @if ($rol->id == $user->roles[0]->id)
                            <option value="{{ $rol->id }}" selected> {{ $rol->name }}</option>
                        @else
                            <option value="{{ $rol->id }}"> {{ $rol->name }}</option>
                        @endif
                    @endforeach
                </select>
                @foreach ($errors->get('idRol') as $error)
                    <div class="form-text text-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    disabled data-undisabled>
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="created" class="form-label">Creado en</label>
                    <input type="text" id="created" class="form-control" placeholder="First name"
                        aria-label="First name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
                        disabled>
                </div>
                <div class="col">
                    <label for="updated" class="form-label">Actualizado en</label>
                    <input type="text" id="updated" class="form-control" placeholder="Last name" aria-label="Last name"
                        value="{{ ucfirst(\Carbon\Carbon::parse($user->updated_at)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y')) }}"
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

@endsection
