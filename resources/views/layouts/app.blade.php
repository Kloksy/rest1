<x-laravel-ui-adminlte::adminlte-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles

<script>
    window.yandexMapsApiKey = @json(config('yandex-maps.api_key')); // Передаем ключ через Blade
</script>
<script src="https://api-maps.yandex.ru/v3/?apikey={{ config('yandex-maps.api_key') }}&lang={{ config('yandex-maps.lang') }}"></script>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />
<!-- jQuery должен быть подключен до Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light tw-border-b tw-border-gray-200">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link tw-text-gray-600" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars tw-text-lg"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto tw-flex tw-items-center">
                    @auth
                        <!-- Авторизованный пользователь -->
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle tw-flex tw-items-center" data-toggle="dropdown">
                                <img src=""
                                    class="user-image img-circle tw-w-8 tw-h-8 tw-object-cover">
                                <span class="tw-ml-2 tw-text-gray-700">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right tw-rounded-lg tw-shadow-xl">
                                <li class="user-header tw-bg-gradient-to-r tw-from-blue-500 tw-to-blue-600">
                                    <img src=""
                                        class="img-circle tw-w-20 tw-h-20">
                                    <p class="tw-text-white tw-mt-2">
                                        {{ Auth::user()->name }}
                                        <small class="tw-block tw-mt-1">Joined {{ Auth::user()->created_at->format('M Y') }}</small>
                                    </p>
                                </li>
                                <li class="user-footer tw-p-4">
                                    <a href="{{ route('profile') }}" 
                                    class="btn btn-default tw-bg-gray-100 hover:tw-bg-gray-200 tw-rounded-lg">
                                        <i class="fas fa-user-circle tw-mr-2"></i>Profile
                                    </a>
                                    <a href="#" 
                                    class="btn btn-default tw-bg-red-100 hover:tw-bg-red-200 tw-rounded-lg tw-float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt tw-mr-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Гости -->
                        <li class="nav-item">
                            <a href="{{ route('login') }}" 
                            class="nav-link tw-text-gray-600 hover:tw-text-blue-600 tw-transition-colors">
                                <i class="fas fa-sign-in-alt tw-mr-1"></i>Login
                            </a>
                        </li>
                        @if(Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" 
                            class="nav-link tw-text-gray-600 hover:tw-text-blue-600 tw-transition-colors tw-ml-4">
                                <i class="fas fa-user-plus tw-mr-1"></i>Register
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper tw-bg-gray-50">
                @yield('content')
            </div>

        </div>
        
        @livewireScripts
        @stack('js')

        @fluxScripts
        
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
