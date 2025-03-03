
<div class="container tw-py-6"> <!-- Единственный корневой элемент -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card tw-border-0 tw-rounded-xl tw-shadow-lg">
                <div class="card-header tw-bg-blue-600 tw-text-white tw-py-4 tw-rounded-t-xl">
                    <h1 class="tw-text-2xl tw-font-bold tw-mb-0">🔍 Поиск заведений</h1>
                </div>
                <div class="card-body tw-p-6">
                    <form wire:submit.prevent="search">
                        <!-- Поиск по названию -->
                        <div class="tw-mb-6">
                            <label for="name" class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Название заведения</label>
                            <input type="text" id="name" 
                                   class="form-control tw-rounded-lg tw-p-3 tw-border-2 tw-border-gray-200 focus:tw-border-blue-500 focus:tw-ring-0" 
                                   wire:model="name" 
                                   placeholder="Введите название...">
                        </div>

                        <div class="tw-grid tw-grid-cols-1 tw-grid-cols-2 tw-gap-6">
                            <!-- Левая колонка -->
                            <div class="tw-space-y-4">
                                <!-- Тип заведения -->
                                <div class="tw-mb-4">
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Тип заведения</label>
                                    <select wire:model="type_id" 
                                            class="form-select tw-w-full tw-py-2 tw-px-3 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-white tw-text-gray-700 focus:tw-border-blue-500 focus:tw-ring-1 focus:tw-ring-blue-500">
                                        <option value="">Любой тип</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Ценовая категория -->
                                <div class="tw-mb-4">
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Ценовая категория</label>
                                    <select wire:model="price_category" 
                                            class="form-select tw-w-full tw-py-2 tw-px-3 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-white tw-text-gray-700 focus:tw-border-blue-500 focus:tw-ring-1 focus:tw-ring-blue-500">
                                        <option value="">Любая цена</option>
                                        <option value="низкие">💰 Низкая</option>
                                        <option value="средние">💰💰 Средняя</option>
                                        <option value="выше среднего">💰💰💰 Выше средней</option>
                                        <option value="высокие">💰💰💰💰 Высокая</option>
                                    </select>
                                </div>

                                <!-- Выбор кухни -->
                                <div class="tw-mb-4" wire:ignore>
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Типы кухни</label>
                                    <select id="cuisine_ids" class="form-control select2 tw-rounded-lg" multiple wire:model="cuisine_ids" data-placeholder="Выберите кухни">
                                        @foreach($cuisines as $cuisine)
                                            <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Дополнительные услуги -->
                                <div class="tw-mb-4" wire:ignore>
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Дополнительные услуги</label>
                                    <select id="general_info_ids" class="form-control select2 tw-rounded-lg" multiple wire:model="general_info_ids" data-placeholder="Выберите услуги">
                                        @foreach($generalInfos as $info)
                                            <option value="{{ $info->id }}">{{ $info->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        
                            <!-- Правая колонка -->
                            <div class="tw-space-y-4">
                                <!-- Рейтинг -->
                                <div class="tw-bg-white tw-rounded-xl tw-border-2 tw-border-gray-100">
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-3">Рейтинг</label>
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-3">
                                        <input type="number" step="0.1" min="0" max="5"
                                               class="form-control tw-rounded-lg tw-p-2.5 tw-border-2 tw-border-gray-200"
                                               wire:model.lazy="min_rating"
                                               placeholder="От">
                                        <input type="number" step="0.1" min="0" max="5"
                                               class="form-control tw-rounded-lg tw-p-2.5 tw-border-2 tw-border-gray-200"
                                               wire:model.lazy="max_rating"
                                               placeholder="До">
                                    </div>
                                    <div class="tw-flex tw-items-center">
                                        <input type="checkbox" 
                                               id="include_empty" 
                                               class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-blue-600" 
                                               wire:model="include_empty_ratings">
                                        <label for="include_empty" class="tw-ml-2 tw-text-gray-600">Включая без рейтинга</label>
                                    </div>
                                </div>
                                <!-- Диапазон цен -->
                                <div class="tw-bg-white tw-rounded-xl tw-border-2 tw-border-gray-100">
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-3">Диапазон цен</label>
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                        <input type="number" 
                                               class="form-control tw-rounded-lg tw-p-2.5 tw-border-2 tw-border-gray-200"
                                               wire:model="min_price" 
                                               placeholder="Мин. цена">
                                        <input type="number" 
                                               class="form-control tw-rounded-lg tw-p-2.5 tw-border-2 tw-border-gray-200"
                                               wire:model="max_price" 
                                               placeholder="Макс. цена">
                                    </div>
                                </div>

                                <!-- Сортировка -->
                                <div class="tw-bg-white tw-rounded-xl tw-border-2 tw-border-gray-100">
                                    <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-3">Сортировка</label>
                                    <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                        <select wire:model="sort_type" 
                                                class="form-select tw-w-full tw-py-2 tw-px-3 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-white tw-text-gray-700 focus:tw-border-blue-500 focus:tw-ring-1 focus:tw-ring-blue-500">
                                            <option value="rating">⭐ Рейтинг</option>
                                            <option value="price">💲 Цена</option>
                                            <option value="distance">📍 Расстояние</option>
                                            <option value="created_at">🕒 Дата добавления</option>
                                        </select>
                                        <select wire:model="sort_direction" 
                                                class="form-select tw-w-full tw-py-2 tw-px-3 tw-border tw-border-gray-300 tw-rounded-lg tw-bg-white tw-text-gray-700 focus:tw-border-blue-500 focus:tw-ring-1 focus:tw-ring-blue-500">
                                            <option value="desc">⬇ По убыванию</option>
                                            <option value="asc">⬆ По возрастанию</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Фильтры -->
                                <div class="tw-bg-white tw-rounded-xl tw-border-2 tw-border-gray-100">
                                    <div class="tw-space-y-2">
                                        <div class="tw-flex tw-items-center">
                                            <input type="checkbox" 
                                                   id="open_now" 
                                                   class="tw-form-checkbox tw-h-4 tw-w-4 tw-text-blue-600" 
                                                   wire:model="open_now">
                                            <label for="open_now" class="tw-ml-2 tw-text-gray-600">🕒 Сейчас открыто</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        
                            
                            <!-- Кнопка поиска -->
                            <div class="tw-flex">
                                <button type="submit" 
                                        class="btn btn-primary tw-px-6 tw-py-3 tw-rounded-lg tw-font-medium 
                                            tw-bg-blue-600 hover:tw-bg-blue-700 tw-transition-colors">
                                    🔍 Найти заведения
                                </button>
                            </div>
                        
                    </form>
                </div>
            </div>

            <!-- Результаты -->
            <div class="tw-m-8">
                @if($establishments->isNotEmpty())
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
                        @foreach($establishments as $establishment)
                            <div class="tw-bg-white tw-rounded-xl tw-shadow-md tw-overflow-hidden hover:tw-shadow-lg tw-transition-shadow">
                                <img src="{{ $establishment->logo_url }}" 
                                     alt="{{ $establishment->name }}" 
                                     class="tw-w-full tw-h-48 tw-object-cover">
                                <div class="tw-p-5">
                                    <h3 class="tw-text-xl tw-font-semibold tw-mb-2">{{ $establishment->name }}</h3>
                                    <div class="tw-flex tw-items-center tw-mb-3">
                                        <span class="tw-bg-blue-100 tw-text-blue-800 tw-text-sm tw-font-medium tw-px-2.5 tw-py-0.5 tw-rounded">
                                            ⭐ {{ $establishment->rating ?? 'Нет оценки' }}
                                        </span>
                                    </div>
                                    <p class="tw-text-gray-600 tw-mb-3">
                                        🍽 {{ implode(', ', $establishment->cuisines->pluck('name')->toArray()) }}
                                    </p>
                                    <a href="{{ route('establishment.card', $establishment->id) }}" 
                                       class="btn btn-success tw-w-full tw-rounded-lg tw-px-4 tw-py-2">
                                        📖 Подробнее
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="tw-text-center tw-py-8 tw-bg-white tw-rounded-xl">
                        <p class="tw-text-gray-500 tw-text-lg">😕 По вашему запросу ничего не найдено</p>
                    </div>
                @endif

                <!-- Пагинация -->
                <div class="tw-mt-6 tw-flex tw-justify-center">
                    {{ $establishments->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>
@script()
    <script>
                $(document).ready(function() {
                    $('#general_info_ids').select2({
                        theme: 'bootstrap4'
                    });
                    $('#general_info_ids').on('change', function(){
                        let data = $(this).val();
                        $wire.general_info_ids = data;

                    })
                });
                $(document).ready(function() {
                    $('#cuisine_ids').select2({
                        theme: 'bootstrap4'
                    });
                    $('#cuisine_ids').on('change', function(){
                        let data = $(this).val();
                        $wire.cuisine_ids = data;

                    })
                });
    </script>
@endscript
