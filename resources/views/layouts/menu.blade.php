@php
$menuItems = [
    [
        'title' => 'Home',
        'route' => route('home'),
        'icon' => 'fas fa-home',
        'active' => 'home'
    ],
    [
        'title' => 'Users',
        'route' => route('users.index'),
        'icon' => 'fas fa-users',
        'active' => 'users*'
    ],
    [
        'title' => 'Establishments',
        'route' => route('establishments.index'),
        'icon' => 'fas fa-store',
        'active' => 'establishments*'
    ],
    [
        'title' => 'Establishment Types',
        'route' => route('establishment-types.index'),
        'icon' => 'fas fa-tags',
        'active' => 'establishment-types*'
    ],
    [
        'title' => 'Contacts',
        'route' => route('contacts.index'),
        'icon' => 'fas fa-address-book',
        'active' => 'contacts*'
    ],
    [
        'title' => 'Working Hours',
        'route' => route('working-hours.index'),
        'icon' => 'fas fa-clock',
        'active' => 'working-hours*'
    ],
    [
        'title' => 'Cuisines',
        'route' => route('cuisines.index'),
        'icon' => 'fas fa-utensils',
        'active' => 'cuisines*'
    ],
    [
        'title' => 'General Infos',
        'route' => route('general-infos.index'),
        'icon' => 'fas fa-info-circle',
        'active' => 'general-infos*'
    ],
    [
        'title' => 'Photos',
        'route' => route('photos.index'),
        'icon' => 'fas fa-camera',
        'active' => 'photos*'
    ],
    [
        'title' => 'User Reviews',
        'route' => route('user-reviews.index'),
        'icon' => 'fas fa-comments',
        'active' => 'user-reviews*'
    ],
    [
        'title' => 'Yandex Reviews',
        'route' => route('yandex-reviews.index'),
        'icon' => 'fab fa-yandex',
        'active' => 'yandex-reviews*'
    ],
    [
        'title' => 'User Preferences',
        'route' => route('userPreferences.index'),
        'icon' => 'fas fa-sliders-h',
        'active' => 'userPreferences*'
    ],
    [
        'title' => 'User Interactions',
        'route' => route('userInteractions.index'),
        'icon' => 'fas fa-exchange-alt',
        'active' => 'userInteractions*'
    ],
    [
        'title' => 'Roles',
        'route' => route('roles.index'),
        'icon' => 'fas fa-user-tag',
        'active' => 'roles*'
    ],
];
@endphp

<!-- Ваше меню с добавленными стилями -->
<ul class="navbar-nav tw-space-y-1 tw-w-full">
    @foreach ($menuItems as $item)
    <li class="nav-item tw-group">
        <a href="{{ $item['route'] }}" 
           class="nav-link tw-flex tw-items-center tw-px-4 tw-py-3 tw-text-gray-600 tw-transition-all tw-duration-300 hover:tw-bg-blue-50 hover:tw-text-blue-600 tw-rounded-lg {{ Request::is($item['active']) ? 'tw-bg-blue-50 tw-text-blue-600 tw-font-semibold' : '' }}">
            <i class="nav-icon tw-w-6 tw-text-center {{ $item['icon'] }} tw-mr-3 tw-text-lg"></i>
            <span class="tw-text-sm">{{ $item['title'] }}</span>
            <!-- Индикатор активной страницы -->
            @if(Request::is($item['active']))
            <div class="tw-absolute tw-left-0 tw-h-6 tw-w-1 tw-bg-blue-600 tw-rounded-r"></div>
            @endif
        </a>
    </li>
    @endforeach
</ul>
