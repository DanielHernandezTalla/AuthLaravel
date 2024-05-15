@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('content')

    @include('components.header')

    <div class="section-content">
        <form action="{{ route('datos.user.store') }}" method="POST" class="p-0">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col-3">
                    <label for="id" class="form-label">Id usuario</label>
                    <input type="text" class="form-control" id="id" value="" disabled data-disabled>
                </div>
                <div class="col">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Escribe el nombre completo" value="{{ old('name') }}">
                    @foreach ($errors->get('name') as $error)
                        <div class="form-text text-danger">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select id="rol" class="form-select" name="idRol">
                    <option value="">Elige un rol</option>
                    @foreach ($roles as $rol)
                        @if ($rol->name == old('idRol'))
                            <option value="{{ $rol->name }}" selected> {{ $rol->name }}</option>
                        @else
                            <option value="{{ $rol->name }}"> {{ $rol->name }}</option>
                        @endif
                    @endforeach
                </select>
                @foreach ($errors->get('idRol') as $error)
                    <div class="form-text text-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Escribe tu correo"
                    value="{{ old('email') }}">
                @foreach ($errors->get('email') as $error)
                    <div class="form-text text-danger">{{ $error }}</div>
                @endforeach
            </div>
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="created" class="form-label">Contraseña</label>
                    <input type="text" id="created" class="form-control" placeholder="Escribre tu contraseña"
                        name="password" value="">
                    @foreach ($errors->get('password') as $error)
                        <div class="form-text text-danger">{{ $error }}</div>
                    @endforeach
                </div>
                <div class="col">
                    <label for="updated" class="form-label">Confirmar contraseña</label>
                    <input type="text" id="updated" class="form-control" name="password_confirmation"
                        placeholder="Escribe la confirmación de contraseña" value="">
                    @foreach ($errors->get('password_confirmation') as $error)
                        <div class="form-text text-danger">{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <button class="btn btn-form-cancel">Cancelar</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-form-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>

@endsection
