@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Добро пожаловать!</h1>

    <!-- Форма поиска заведений -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Поиск заведений</div>
        <div class="card-body">
            <form action="{{ route('search') }}" method="GET">
                <!-- Фильтры -->
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="type" class="form-label">Тип заведения:</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">Любой тип</option>
                            @foreach ($establishmentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="cuisine" class="form-label">Кухня:</label>
                        <select name="cuisine" id="cuisine" class="form-select">
                            <option value="">Любая кухня</option>
                            @foreach ($cuisines as $cuisine)
                                <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="price_category" class="form-label">Ценовая категория:</label>
                        <select name="price_category" id="price_category" class="form-select">
                            <option value="">Любая цена</option>
                            <option value="низкие">Низкая</option>
                            <option value="средние">Средняя</option>
                            <option value="выше среднего">Выше средней</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="address" class="form-label">Адрес:</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Введите адрес или используйте текущее местоположение">
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary">Найти заведения</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
</div>
@endsection
@endsection
