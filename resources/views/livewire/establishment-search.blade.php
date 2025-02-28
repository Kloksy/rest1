<div class="container">
    <div class="row justify-content-center">
        <div class="col-mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Поиск заведений</div>
                <div class="card-body">
                    <form wire:submit.prevent="search">
                        <div class="mb-3">
                            <label for="name" class="form-label">Название заведения:</label>
                            <input type="text" id="name" class="form-control" wire:model="name" placeholder="Введите название">
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Тип заведения:</label>
                            <select id="type_id" class="custom-select" wire:model="type_id"> 
                                <option value="">Любой тип</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="price_category" class="form-label">Ценовая категория:</label>
                            <select id="price_category" class="custom-select" wire:model="price_category">
                                <option value="">Любая цена</option>
                                <option value="низкие">Низкая</option>
                                <option value="средние">Средняя</option>
                                <option value="выше среднего">Выше средней</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Кухня:</label>
                            <select id="cuisine_ids" class="custom-select select2" multiple wire:model="cuisine_ids" data-placeholder="Выберите кухню">
                                @foreach ($cuisines as $cuisine)
                                    <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Дополнительные услуги:</label>
                            <select id="general_info_ids" class="custom-select select2" multiple wire:model="general_info_ids" data-placeholder="Выберите услуги">
                                @foreach ($generalInfos as $info)
                                    <option value="{{ $info->id }}">{{ $info->name }}</option>
                                @endforeach
                            </select>
                        </div>
                      

                        <button type="submit" class="btn btn-primary">Найти заведения</button>
                    </form>
                </div>
            </div>

            <!-- Результаты поиска -->
            <div class="mt-4">
                @if ($establishments->isNotEmpty())
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($establishments as $establishment)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ $establishment->logo_url }}" alt="{{ $establishment->name }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $establishment->name }}</h5>
                                        <p class="card-text">Рейтинг: {{ $establishment->rating ?? 'Нет данных' }}/5</p>
                                        <p class="card-text">Кухня: {{ implode(', ', $establishment->cuisines->pluck('name')->toArray()) }}</p>
                                        <a href="{{ route('establishment.card', $establishment->id) }}" class="btn btn-success">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>По вашему запросу ничего не найдено.</p>
                @endif

                <!-- Пагинация -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $establishments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>



