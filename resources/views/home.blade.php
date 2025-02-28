
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Добро пожаловать!</h1>


    @livewire('establishment-search')

    <!-- Популярные заведения -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Популярные заведения</div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($popularEstablishments as $establishment)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $establishment->name }}</h5>
                                <p class="card-text">Рейтинг: {{ $establishment->rating }}/5</p>
                                <p class="card-text">Кухня: {{ implode(', ', $establishment->cuisines->pluck('name')->toArray()) }}</p>
                                <a href="{{ route('establishment.card', $establishment->id) }}" class="btn btn-success">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Рекомендации -->
    <div class="card">
        <div class="card-header bg-info text-white">
            @if (auth()->check())
                Персонализированные рекомендации
            @else
                Заведения поблизости
            @endif
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($recommendations as $establishment)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $establishment->name }}</h5>
                                <p class="card-text">Рейтинг: {{ $establishment->rating }}/5</p>
                                <p class="card-text">Кухня: {{ implode(', ', $establishment->cuisines->pluck('name')->toArray()) }}</p>
                                <a href="{{ route('establishment.card', $establishment->id) }}" class="btn btn-info">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</div>
@endsection
