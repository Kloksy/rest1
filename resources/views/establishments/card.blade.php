@extends('layouts.app')

@section('content')
<div class="container tw-py-8">
    <!-- Хедер -->
    <div class="tw-text-center tw-mb-8">
        <div class="tw-inline-block tw-relative tw-group">
            <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" 
                 class="tw-w-48 tw-h-48 tw-object-cover tw-rounded-full tw-border-4 tw-border-white tw-shadow-lg 
                        group-hover:tw-scale-105 tw-transition-transform">
            <div class="tw-absolute tw-inset-0 tw-rounded-full tw-border-2 tw-border-blue-100 tw-pointer-events-none"></div>
        </div>
        <h1 class="tw-text-4xl tw-font-bold tw-mt-6 tw-mb-2">{{ $establishment->name }}</h1>
        <div class="tw-flex tw-justify-center tw-items-center tw-space-x-2">
            <span class="tw-badge tw-bg-yellow-400 tw-text-yellow-900 tw-py-2 tw-px-4 tw-rounded-full">
                Рейтинг на YandexMaps ⭐ {{ $establishment->rating ?? 'Нет оценки' }}
            </span>
            <span class="tw-badge tw-bg-yellow-400 tw-text-yellow-900 tw-py-2 tw-px-4 tw-rounded-full">
                Рейтинг на Сайте ⭐ @if ($establishment->calculateUserRating() > 0)
                                        {{ $establishment->calculateUserRating() }}
                                    @else
                                        Нет оценки
                                    @endif
            </span>
        </div>
    </div>

    <!-- Основная информация -->
    <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-8 tw-mb-8">
        <!-- Детали -->
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6">
            <h2 class="tw-text-2xl tw-font-semibold tw-mb-4 tw-border-b tw-border-gray-200 tw-pb-2">
                <i class="fas fa-info-circle tw-text-blue-500 tw-mr-2"></i>Основная информация
            </h2>
            
            <div class="tw-space-y-4">
                <div class="tw-flex">
                    <div class="tw-w-1/3 tw-font-medium tw-text-gray-500">Тип заведения</div>
                    <div class="tw-w-2/3">{{ $establishment->type->name ?? 'Не указан' }}</div>
                </div>
                <div class="tw-flex">
                    <div class="tw-w-1/3 tw-font-medium tw-text-gray-500">Адрес</div>
                    <div class="tw-w-2/3">
                        <a href="#" class="tw-text-blue-500 hover:tw-text-blue-700">
                            <i class="fas fa-map-marker-alt tw-mr-2"></i>{{ $establishment->address }}
                        </a>
                    </div>
                </div>
                <div class="tw-flex">
                    <div class="tw-w-1/3 tw-font-medium tw-text-gray-500">Средний чек</div>
                    <div class="tw-w-2/3 tw-font-medium tw-text-green-600">
                        {{ $establishment->average_bill ?? 'Не указан' }}
                    </div>
                </div>
                <div class="tw-flex">
                    <div class="tw-w-1/3 tw-font-medium tw-text-gray-500">Цены</div>
                    <div class="tw-w-2/3 tw-font-medium tw-text-green-600">
                    {{ $establishment->price_category ?? 'Ценовая категория не указана' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Карта -->
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-4">
            <h2 class="tw-text-2xl tw-font-semibold tw-mb-4 tw-border-b tw-border-gray-200 tw-pb-2">
                <i class="fas fa-map-marked-alt tw-text-green-500 tw-mr-2"></i>Расположение
            </h2>
            <div id='map' class="tw-h-64 tw-bg-gray-100 tw-rounded-lg tw-overflow-hidden">
            </div>
        </div>
    </div>

    <!-- Особенности -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-8">
        @if($establishment->cuisines->isNotEmpty())
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6">
            <h3 class="tw-text-xl tw-font-semibold tw-mb-3">
                <i class="fas fa-utensils tw-text-red-500 tw-mr-2"></i>Кухня
            </h3>
            <div class="tw-flex tw-flex-wrap tw-gap-2">
                @foreach($establishment->cuisines as $cuisine)
                <span class="tw-badge tw-bg-red-100 tw-text-red-800 tw-px-3 tw-py-1 tw-rounded-full">
                    {{ $cuisine->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        @if($establishment->generalInfos->isNotEmpty())
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6">
            <h3 class="tw-text-xl tw-font-semibold tw-mb-3">
                <i class="fas fa-star tw-text-yellow-500 tw-mr-2"></i>Услуги и особенности
            </h3>
            <div class="tw-flex tw-flex-wrap tw-gap-2">
                @foreach($establishment->generalInfos as $info)
                <span class="tw-badge tw-bg-purple-100 tw-text-purple-800 tw-px-3 tw-py-1 tw-rounded-full">
                    {{ $info->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Галерея -->
    @if($establishment->photos->isNotEmpty())
    <div class="tw-mb-8">
        <h2 class="tw-text-2xl tw-font-semibold tw-mb-4">
            <i class="fas fa-camera tw-text-blue-500 tw-mr-2"></i>Фотогалерея
        </h2>
        <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-4">
            @foreach($establishment->photos as $photo)
            <a href="{{ $photo->url }}" data-fancybox="gallery" 
               class="tw-block tw-group tw-relative tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-lg tw-transition-shadow">
                <img src="{{ $photo->url }}" alt="Фото заведения" 
                     class="tw-w-full tw-h-48 tw-object-cover group-hover:tw-scale-105 tw-transition-transform">
                <div class="tw-absolute tw-inset-0 tw-bg-black/20 tw-flex tw-items-center tw-justify-center tw-opacity-0 group-hover:tw-opacity-100 tw-transition-opacity">
                    <i class="fas fa-search-plus tw-text-3xl tw-text-white"></i>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- График работы -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4 tw-mb-8">
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6 tw-mb-8">
            <h2 class="tw-text-2xl tw-font-semibold tw-mb-4">
                <i class="fas fa-clock tw-text-green-500 tw-mr-2"></i>График работы
            </h2>
            <div class="tw-divide-y tw-divide-gray-200">
                @foreach($establishment->workingHours as $workingHour)
                <div class="tw-flex tw-items-center tw-justify-between tw-py-3">
                    <span class="tw-text-gray-600">{{ $daysOfWeek[$workingHour->day] ?? $workingHour->day }}</span>
                    <span class="tw-font-medium">{{ $workingHour->hours }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6 tw-mb-8">
            <h2 class="tw-text-2xl tw-font-semibold tw-mb-4">
                <i class="fas fa-link tw-text-blue-500 tw-mr-2"></i>Контакты
            </h2>
            <div class="tw-divide-y tw-divide-gray-200">
                @foreach($establishment->contacts as $contact)
                <div class="tw-flex tw-items-center tw-justify-between tw-py-3">
                    <a href="{{ $contact->value }}" class="tw-text-blue-500 hover:tw-text-blue-700">
                        <span class="tw-w-1/3 tw-font-medium tw-text-gray-500">{{ $contact->type }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Отзывы -->
    <div class="tw-bg-white tw-rounded-xl tw-shadow-lg tw-p-6">
        <h2 class="tw-text-2xl tw-font-semibold tw-mb-6">
            <i class="fas fa-comments tw-text-purple-500 tw-mr-2"></i>Отзывы
        </h2>
    
        <!-- Навигация табов -->
        <ul class="nav nav-tabs tw-mb-4" id="reviewsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" 
                        id="yandex-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#yandex-reviews" 
                        type="button" 
                        role="tab" 
                        aria-controls="yandex-reviews" 
                        aria-selected="true">
                    Яндекс Отзывы ({{ $establishment->yandexReviews->count() }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" 
                        id="users-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#user-reviews" 
                        type="button" 
                        role="tab" 
                        aria-controls="user-reviews" 
                        aria-selected="false">
                    Пользовательские отзывы ({{ $establishment->userReviews->count() }})
                </button>
            </li>
        </ul>
        

        <div class="tab-content" id="reviewsTabContent">
            <div class="tab-pane fade show active" id="yandex-reviews" role="tabpanel">
                @livewire('yandex-reviews', ['establishment' => $establishment], key('yandex-'.$establishment->id))
            </div>
            
            <div class="tab-pane fade" id="user-reviews" role="tabpanel">
                @livewire('user-reviews', ['establishment' => $establishment], key('user-'.$establishment->id))
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Добавляем недостающие стили Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.nav-tabs {
    @apply tw-border-b tw-border-gray-200;
}

.nav-tabs .nav-link {
    @apply tw-border-0 tw-px-4 tw-py-2 tw-text-gray-500 hover:tw-text-blue-600;
}

.nav-tabs .nav-link.active {
    @apply tw-border-b-2 tw-border-blue-500 tw-text-blue-600 tw-bg-transparent;
}

.tab-content > .tab-pane {
    @apply tw-p-3;
}
</style>  
<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
//TAB
document.addEventListener('livewire:load', function() {
    const triggerTabList = [].slice.call(document.querySelectorAll('#reviewsTab button'))
    
    triggerTabList.forEach(function (triggerEl) {
        triggerEl.addEventListener('shown.bs.tab', function (event) {
            const target = event.target.getAttribute('data-bs-target')
            Livewire.emit('tabChanged', target)
        })
    })
})

initMap();

async function initMap() {
    // Промис `ymaps3.ready` будет зарезолвлен, когда загрузятся все компоненты основного модуля API
    await ymaps3.ready;

    const {YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer} = ymaps3;
    // Иницилиазируем карту
    const map = new YMap(
        // Передаём ссылку на HTMLElement контейнера
        document.getElementById('map'),
        // Передаём параметры инициализации карты
        {
            location: {
                // Координаты центра карты
                center: [@json($establishment->longitude), @json($establishment->latitude)],
                // Уровень масштабирования
                zoom: 17
            }
        }
    );
    // Добавляем слой для отображения схематической карты
    map.addChild(new YMapDefaultSchemeLayer());

    // Добавляем слой объектов
    map.addChild(new YMapDefaultFeaturesLayer())

    // Подключение модуля меток
    const {YMapDefaultMarker} = (await ymaps3.import('@yandex/ymaps3-markers@0.0.1'));

    // Создание метки
    const myPlacemark = new YMapDefaultMarker({
        "coordinates": [@json($establishment->longitude), @json($establishment->latitude)],
        "color": "orange",
        "title": @json($establishment->name),
        "subtitle": @json($establishment->type->name)
    });
    map.addChild(myPlacemark);
}
</script>

@endsection