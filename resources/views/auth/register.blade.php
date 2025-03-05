
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
                                    <h2 class="mt-3 tw-text-2xl tw-font-bold tw-text-gray-900">Создать аккаунт</h2>
                                    <p class="tw-text-gray-600">Зарегистрируйтесь бесплатно</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Имя -->
                                    <div class="mb-4">
                                        <label class="form-label tw-text-gray-700">Имя</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user tw-text-gray-400"></i>
                                            </span>
                                            <input 
                                                type="text" 
                                                name="name"
                                                class="form-control tw-rounded-lg @error('name') is-invalid @enderror"
                                                placeholder="Ваше имя"
                                                value="{{ old('name') }}"
                                                required
                                                autofocus
                                            >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

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
                                        <label class="form-label tw-text-gray-700">Пароль</label>
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

                                    <!-- Подтверждение пароля -->
                                    <div class="mb-4">
                                        <label class="form-label tw-text-gray-700">Подтвердите пароль</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock tw-text-gray-400"></i>
                                            </span>
                                            <input 
                                                type="password" 
                                                name="password_confirmation"
                                                class="form-control tw-rounded-lg"
                                                placeholder="••••••••"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <!-- Соглашение -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="terms" 
                                                id="terms"
                                                required
                                            >
                                            <label class="form-check-label tw-text-gray-600" for="terms">
                                                Я согласен с <a href="#" class="tw-text-primary-600 hover:tw-text-primary-800">условиями использования</a>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Кнопка регистрации -->
                                    <button type="submit" class="btn btn-primary w-100 tw-py-2.5 tw-rounded-lg tw-font-medium">
                                        <i class="fas fa-user-plus tw-mr-2"></i>Зарегистрироваться
                                    </button>

                                    <!-- Вход -->
                                    <div class="text-center mt-4">
                                        <span class="tw-text-gray-600">Уже есть аккаунт? </span>
                                        <a href="{{ route('login') }}" class="tw-text-primary-600 hover:tw-text-primary-800">
                                            Войти
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.tw-rounded-2xl {
    border-radius: 1rem;
}

.input-group-text {
    transition: all 0.3s ease;
}

.form-control:focus + .input-group-text {
    color: #4f46e5;
}

.btn-primary {
    transition: all 0.3s ease;
    background-color: #4f46e5;
    border-color: #4f46e5;
}

.btn-primary:hover {
    background-color: #4338ca;
    border-color: #4338ca;
    transform: translateY(-1px);
}
</style>
</x-laravel-ui-adminlte::adminlte-layout>

@endsection

