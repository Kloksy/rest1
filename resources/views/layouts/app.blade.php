<x-laravel-ui-adminlte::adminlte-layout>
@livewireStyles


<script>
    window.yandexMapsApiKey = @json(config('yandex-maps.api_key')); // Передаем ключ через Blade
</script>
<script src="https://api-maps.yandex.ru/v3/?apikey={{ config('yandex-maps.api_key') }}&lang={{ config('yandex-maps.lang') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">

<script src="https://cdn.tailwindcss.com"></script>
<link href="{{ asset('css/app.css', 'js/yandexmaps.js') }}" rel="stylesheet">

<script>
  tailwind.config = {
    prefix: 'tw-',
    corePlugins: {
      preflight: false,
    },
    important: true
  }
</script>


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
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                                    class="user-image img-circle elevation-2" alt="User Image">
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <!-- User image -->
                                <li class="user-header bg-primary">
                                    <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                                        class="img-circle elevation-2" alt="User Image">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    <a href="#" class="btn btn-default btn-flat float-right"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>

        </div>
        
        @livewireScripts
        @stack('js')

        @fluxScripts
        
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
