@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">{{ $establishment->name }}</h1>

    <!-- Логотип заведения -->
    <div class="text-center mb-4">
        <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" class="img-fluid" style="max-width: 200px;">
    </div>

    <!-- Основная информация -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Основная информация</div>
        <div class="card-body">
            <p><strong>Тип:</strong> {{ $establishment->type->name ?? 'Не указано' }}</p>
            <p><strong>Рейтинг:</strong> {{ $establishment->rating ?? 'Нет данных' }}/5</p>
            <p><strong>Адрес:</strong> {{ $establishment->address }}</p>
            <p><strong>Ценовая категория:</strong> {{ $establishment->price_category ?? 'Не указана' }}</p>
            <p><strong>Средний чек:</strong> {{ $establishment->average_bill ?? 'Не указан' }}</p>
        </div>
    </div>

    <!-- Фотографии -->
    @if ($establishment->photos->isNotEmpty())
        <div class="card">
            <div class="card-header bg-dark text-white">Фотографии</div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($establishment->photos as $photo)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $photo->url }}" alt="Фото заведения" class="card-img-top" style="height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p>Фотографий заведения пока нет.</p>
    @endif

    <!-- Типы кухонь -->
    @if ($establishment->cuisines->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Кухня</div>
            <div class="card-body">
                <ul>
                    @foreach ($establishment->cuisines as $cuisine)
                        <li>{{ $cuisine->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Дополнительные услуги -->
    @if ($establishment->generalInfos->isNotEmpty())
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Дополнительные услуги</div>
            <div class="card-body">
                <ul>
                    @foreach ($establishment->generalInfos as $info)
                        <li>{{ $info->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

@php
    $daysOfWeek = [
        'Mo' => 'Понедельник',
        'Tu' => 'Вторник',
        'We' => 'Среда',
        'Th' => 'Четверг',
        'Fr' => 'Пятница',
        'Sa' => 'Суббота',
        'Su' => 'Воскресенье',
    ];
@endphp

    <!-- График работы -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">График работы</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>День недели</th>
                        <th>Время работы</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($establishment->workingHours as $workingHour)
                        <tr>
                            <td>{{ $daysOfWeek[$workingHour->day] ?? 'Неизвестный день' }}</td>
                            <td>{{ $workingHour->hours }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Отзывы -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Отзывы</div>
        <div class="card-body">
            <!-- Отзывы из Yandex Maps -->
            @if ($establishment->yandexReviews->isNotEmpty())
                <h5 class="mb-3">Отзывы с Yandex Maps</h5>
                <div class="row g-3">
                    @foreach ($establishment->yandexReviews as $review)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p><strong>Автор:</strong> {{ $review->user_name }}</p>
                                    <p><strong>Рейтинг:</strong> {{ $review->rating }}/5</p>
                                    <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</p>
                                    <p>{{ $review->review_text }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Отзывов с Yandex Maps пока нет.</p>
            @endif

            <!-- Отзывы пользователей -->
            @if ($establishment->userReviews->isNotEmpty())
                <h5 class="mb-3">Отзывы пользователей</h5>
                <div class="row g-3">
                    @foreach ($establishment->userReviews as $review)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p><strong>Автор:</strong> {{ $review->user->name }}</p>
                                    <p><strong>Рейтинг:</strong> {{ $review->rating }}/5</p>
                                    <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($review->created_at)->format('d.m.Y') }}</p>
                                    <p>{{ $review->review_text }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Пользовательских отзывов пока нет.</p>
            @endif
        </div>
    </div>

</div>
@endsection