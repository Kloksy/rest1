@extends('layouts.app')

@section('content')
<x-laravel-ui-adminlte::adminlte-layout>

    <div class="min-vh-100 d-flex align-items-center bg-gradient-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-lg tw-rounded-2xl tw-border-0">
                        <div class="card-body p-5">
                            <!-- Логотип -->
                            <div class="text-center mb-5">
                                <h2 class="mt-3 tw-text-2xl tw-font-bold tw-text-gray-900">Добро пожаловать</h2>
                                <p class="tw-text-gray-600">Войдите в свой аккаунт</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <!-- Email -->
                                <div class="mb-4">
                                    <label class="form-label tw-text-gray-700">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope tw-text-gray-400"></i>
                                        </span>
                                        <input 
                                            type="email" 
                                            name="email"
                                            class="form-control tw-rounded-lg @error('email') is-invalid @enderror"
                                            placeholder="example@domain.com"
                                            value="{{ old('email') }}"
                                            required
                                            autofocus
                                        >
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Пароль -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label tw-text-gray-700">Пароль</label>
                                        <a href="{{ route('password.request') }}" class="tw-text-sm tw-text-primary-600 hover:tw-text-primary-800">
                                            Забыли пароль?
                                        </a>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock tw-text-gray-400"></i>
                                        </span>
                                        <input 
                                            type="password" 
                                            name="password"
                                            class="form-control tw-rounded-lg @error('password') is-invalid @enderror"
                                            placeholder="••••••••"
                                            required
                                        >
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Запомнить меня -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="remember" 
                                            id="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label tw-text-gray-600" for="remember">
                                            Запомнить меня
                                        </label>
                                    </div>
                                </div>

                                <!-- Кнопка входа -->
                                <button type="submit" class="btn btn-primary w-100 tw-py-2.5 tw-rounded-lg tw-font-medium">
                                    <i class="fas fa-sign-in-alt tw-mr-2"></i>Войти
                                </button>

                                <!-- Регистрация -->
                                <div class="text-center mt-4">
                                    <span class="tw-text-gray-600">Ещё нет аккаунта? </span>
                                    <a href="{{ route('register') }}" class="tw-text-primary-600 hover:tw-text-primary-800">
                                        Создать аккаунт
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-laravel-ui-adminlte::adminlte-layout>
@endsection