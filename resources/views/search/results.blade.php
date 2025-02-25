@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Результаты поиска</h1>

    @if ($establishments->isEmpty())
        <p>По вашему запросу ничего не найдено.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($establishments as $establishment)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $establishment->name }}</h5>
                            <p class="card-text">Рейтинг: {{ $establishment->rating }}/5</p>
                            <p class="card-text">Кухня: {{ implode(', ', $establishment->cuisines->pluck('name')->toArray()) }}</p>
                            <a href="{{ route('establishment.card', $establishment->id) }}" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $establishments->links() }}
        </div>
    @endif
</div>
@endsection