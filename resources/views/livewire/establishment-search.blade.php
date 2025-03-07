<div class="container tw-py-8">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Карточка поиска -->
            <div class="card tw-border-0 tw-rounded-2xl tw-shadow-xl tw-bg-gradient-to-br tw-from-blue-100 tw-to-indigo-50">
                <div class="card-header tw-bg-gradient-to-r tw-from-blue-600 tw-to-indigo-600 tw-text-white tw-py-5 tw-rounded-t-2xl">
                    <h1 class="tw-text-3xl tw-font-bold tw-mb-0 tw-flex tw-items-center">
                        <i class="fas fa-search tw-mr-3"></i> Поиск заведений
                    </h1>
                </div>
                
                <div class="card-body tw-p-8">
                    <form wire:submit.prevent="search" class="tw-space-y-6">
                        <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-gap-8">
                            
                            <!-- Левая колонка -->
                            <div class="tw-space-y-6">
                                <!-- Название -->
                                <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
                                    <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-3 tw-text-lg">
                                        Название заведения
                                    </label>
                                    <input type="text" 
                                           class="tw-w-full tw-p-3 tw-border-2 tw-border-gray-200 tw-rounded-lg 
                                                  focus:tw-ring-2 focus:tw-ring-blue-400 focus:tw-border-blue-400 
                                                  tw-transition-all" 
                                           placeholder="Введите название..."
                                           wire:model="name">
                                </div>

                                <!-- Тип и цена -->
                                <div class="tw-grid tw-grid-cols-1 tw-gap-6">
                                    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
                                        <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-3 tw-text-lg">
                                            Тип заведения
                                        </label>
                                        <select wire:model="type_id" 
                                                class="tw-w-full tw-p-3 tw-border-2 tw-border-gray-200 tw-rounded-lg 
                                                       focus:tw-ring-2 focus:tw-ring-blue-400 tw-transition-all">
                                            <option value="">Все типы</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
                                        <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-3 tw-text-lg">
                                            Ценовая категория
                                        </label>
                                        <select wire:model="price_category" 
                                                class="tw-w-full tw-p-3 tw-border-2 tw-border-gray-200 tw-rounded-lg 
                                                       focus:tw-ring-2 focus:tw-ring-blue-400 tw-transition-all">
                                            <option value="">Любая цена</option>
                                            @foreach(['Низкие', 'Средние', 'Выше среднего', 'Высокие'] as $price)
                                                <option value="{{ $price }}">
                                                    {{ ucfirst($price) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Выбор кухни и услуг -->
                                <div class="tw-space-y-6">
                                    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm" wire:ignore>
                                        <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-3 tw-text-lg">
                                            Типы кухни
                                        </label>
                                        <select id="cuisine_ids" 
                                                class="select2 tw-w-full" 
                                                multiple 
                                                data-placeholder="Выберите кухни"
                                                wire:model="cuisine_ids">
                                            @foreach($cuisines as $cuisine)
                                                <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm" wire:ignore>
                                        <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-3 tw-text-lg">
                                            Услуги
                                        </label>
                                        <select id="general_info_ids" 
                                                class="select2 tw-w-full" 
                                                multiple 
                                                data-placeholder="Выберите услуги"
                                                wire:model="general_info_ids">
                                            @foreach($generalInfos as $info)
                                                <option value="{{ $info->id }}">{{ $info->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Правая колонка -->
                            <div class="tw-space-y-6">
                                <!-- Рейтинг и цена -->
                                <div class="tw-bg-white tw-rounded-xl tw-p-6 tw-shadow-sm">
                                    <label class="tw-block tw-text-gray-700 tw-font-semibold tw-mb-4 tw-text-lg">
                                        Фильтры
                                    </label>
                                    
                                    <div class="tw-space-y-6">
                                        <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                            <div>
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Рейтинг от</label>
                                                <input type="number" 
                                                       class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg" 
                                                       wire:model.lazy="min_rating" 
                                                       placeholder="0" 
                                                       min="0" 
                                                       max="5" 
                                                       step="0.1">
                                            </div>
                                            <div>
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Рейтинг до</label>
                                                <input type="number" 
                                                       class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg" 
                                                       wire:model.lazy="max_rating" 
                                                       placeholder="5" 
                                                       min="0" 
                                                       max="5" 
                                                       step="0.1">
                                            </div>
                                        </div>

                                        <div class="tw-grid tw-grid-cols-2 tw-gap-4">
                                            <div>
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Цена от</label>
                                                <input type="number" 
                                                       class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg" 
                                                       wire:model="min_price" 
                                                       placeholder="Мин. сумма">
                                            </div>
                                            <div>
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Цена до</label>
                                                <input type="number" 
                                                       class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg" 
                                                       wire:model="max_price" 
                                                       placeholder="Макс. сумма">
                                            </div>
                                        </div>

                                        <div class="tw-flex tw-items-center tw-space-x-4">
                                            <div class="tw-flex-1">
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Сортировка</label>
                                                <select wire:model="sort_type" 
                                                        class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg">
                                                    <option value="rating">По рейтингу</option>
                                                    <option value="price">По цене</option>
                                                    <option value="distance">По расстоянию</option>
                                                </select>
                                            </div>
                                            <div class="tw-flex-1">
                                                <label class="tw-block tw-text-gray-600 tw-mb-2">Направление</label>
                                                <select wire:model="sort_direction" 
                                                        class="tw-w-full tw-p-2.5 tw-border-2 tw-border-gray-200 tw-rounded-lg">
                                                    <option value="desc">По убыванию</option>
                                                    <option value="asc">По возрастанию</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="tw-flex tw-items-center tw-space-x-4">
                                            <label class="tw-flex tw-items-center">
                                                <input type="checkbox" 
                                                       class="tw-form-checkbox tw-h-5 tw-w-5 tw-text-blue-600" 
                                                       wire:model="open_now">
                                                <span class="tw-ml-2 tw-text-gray-600">Сейчас открыто</span>
                                            </label>
                                            <label class="tw-flex tw-items-center">
                                                <input type="checkbox" 
                                                       class="tw-form-checkbox tw-h-5 tw-w-5 tw-text-blue-600" 
                                                       wire:model="include_empty_ratings">
                                                <span class="tw-ml-2 tw-text-gray-600">Включая без рейтинга</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Кнопка поиска -->
                                <button type="submit" 
                                        class="tw-w-full tw-p-4 tw-bg-gradient-to-r tw-from-blue-600 tw-to-indigo-600 
                                               tw-text-white tw-font-bold tw-rounded-xl tw-shadow-lg 
                                               hover:tw-shadow-xl tw-transition-all">
                                    <i class="fas fa-search tw-mr-2"></i> Найти заведения
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Результаты -->
            <div class="tw-mt-10">
                @if($establishments->isNotEmpty())
                    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">
                        @foreach($establishments as $establishment)
                            <div class="tw-bg-white tw-rounded-2xl tw-shadow-md tw-overflow-hidden 
                                      hover:tw-transform hover:tw-scale-[1.02] tw-transition-all">
                                <div class="tw-relative tw-h-48">
                                    <img src="{{ $establishment->logo_url }}" 
                                         alt="{{ $establishment->name }}" 
                                         class="tw-w-full tw-h-full tw-object-cover">
                                    <div class="tw-absolute tw-bottom-2 tw-right-2 tw-bg-white/80 tw-px-3 tw-py-1 tw-rounded-full">
                                        <span class="tw-text-sm tw-font-semibold tw-text-blue-600">
                                            <i class="fas fa-star tw-mr-3"></i> {{ $establishment->rating ?? '–' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="tw-p-6">
                                    <h3 class="tw-text-xl tw-font-bold tw-mb-2">{{ $establishment->name }}</h3>
                                    <div class="tw-flex tw-flex-wrap tw-gap-2 tw-mb-4">
                                        @foreach($establishment->cuisines as $cuisine)
                                            <span class="tw-bg-blue-100 tw-text-blue-800 tw-text-sm tw-px-3 tw-py-1 tw-rounded-full">
                                                {{ $cuisine->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('establishment.card', $establishment->id) }}" 
                                       class="tw-w-full tw-inline-block tw-text-center tw-p-3 tw-bg-blue-600 
                                              tw-text-white tw-rounded-lg hover:tw-bg-blue-700 tw-transition-colors">
                                        Подробнее →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="tw-text-center tw-py-12 tw-bg-white tw-rounded-2xl tw-shadow-sm tw-mt-6">
                        <div class="tw-text-6xl tw-mb-4">😕</div>
                        <p class="tw-text-gray-500 tw-text-xl">Ничего не найдено</p>
                    </div>
                @endif

                <!-- Пагинация -->
                <div class="tw-mt-8 tw-flex tw-justify-center">
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
