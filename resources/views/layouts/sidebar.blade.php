<aside class="main-sidebar tw-bg-gradient-to-b tw-from-slate-800 tw-to-slate-900 tw-shadow-xl tw-min-h-screen tw-w-64 tw-fixed">
    <!-- Логотип -->
    <a href="{{ route('home') }}" class="brand-link tw-block tw-p-4 tw-border-b tw-border-slate-700 hover:tw-bg-slate-700 tw-transition-colors">
        <div class="tw-flex tw-items-center tw-space-x-3">
            <img src="" 
                 alt="AdminLTE Logo" 
                 class="brand-image tw-w-10 tw-h-10 tw-object-contain tw-animate-spin-slow">
            <span class="brand-text tw-text-xl tw-font-bold tw-text-white tw-tracking-wider">
                {{ config('app.name') }}
            </span>
        </div>
    </a>

    <!-- Основное меню -->
    <div class="sidebar tw-p-4 tw-overflow-y-auto tw-scrollbar-thin tw-scrollbar-thumb-slate-600 tw-scrollbar-track-slate-800">
        <nav class="tw-space-y-2">
            <ul class="nav nav-pills nav-sidebar tw-flex-col tw-space-y-2">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
