<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('establishments.index') }}" class="nav-link {{ Request::is('establishments*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Establishments</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('establishment-types.index') }}" class="nav-link {{ Request::is('establishment-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Establishment Types</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('contacts.index') }}" class="nav-link {{ Request::is('contacts*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Contacts</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('working-hours.index') }}" class="nav-link {{ Request::is('working-hours*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Working Hours</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('cuisines.index') }}" class="nav-link {{ Request::is('cuisines*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Cuisines</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('general-infos.index') }}" class="nav-link {{ Request::is('general-infos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>General Infos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('photos.index') }}" class="nav-link {{ Request::is('photos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Photos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user-reviews.index') }}" class="nav-link {{ Request::is('user-reviews*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Reviews</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('yandex-reviews.index') }}" class="nav-link {{ Request::is('yandex-reviews*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Yandex Reviews</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('establishmentTypes.index') }}" class="nav-link {{ Request::is('establishmentTypes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Establishment Types</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userPreferences.index') }}" class="nav-link {{ Request::is('userPreferences*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Preferences</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userInteractions.index') }}" class="nav-link {{ Request::is('userInteractions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Interactions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Roles</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('yandexReviews.index') }}" class="nav-link {{ Request::is('yandexReviews*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Yandex Reviews</p>
    </a>
</li>
