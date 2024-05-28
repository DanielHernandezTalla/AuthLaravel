@extends('layouts.auth')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="section d-lg-flex flex-row shadow-lg">
                    <div class="card-body">
                        <img class="mb-2" width="32" height="40" src="/images/logo.png" alt="logo">
                        <h1>{{ __('Login') }}</h1>
                        <div class="fw-bold text-secondary">{{ __('Reset Password') }}</div>
                        {{-- <div class="fw-bold text-secondary">Usa tu cuenta de Google</div> --}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Correo Electrónico">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="window.location.href = '/login'">
                                        {{ __('Cancelar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
