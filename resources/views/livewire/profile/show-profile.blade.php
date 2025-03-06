@extends('layouts.app')
@section('content')
<div class="tw-container tw-mx-auto tw-p-4">
    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-3 tw-gap-6">
        <!-- Левая колонка - Основная информация -->
        <div class="lg:tw-col-span-1">
            @livewire('profile.update-profile-form')
            @livewire('profile.update-password-form')
        </div>

        <!-- Правая колонка - Предпочтения -->
        <div class="lg:tw-col-span-2">
            @livewire('profile.update-preferences-form')
            
        </div>
    </div>
</div>
@endsection