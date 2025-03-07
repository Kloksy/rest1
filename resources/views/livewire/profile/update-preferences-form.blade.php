

<div class="tw-bg-white tw-rounded-lg tw-shadow tw-p-6">
    <h3 class="tw-text-xl tw-font-semibold tw-mb-4">Мои предпочтения</h3>
    
    <form wire:submit="save">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6"> <!-- Меняем на 3 колонки -->
            <!-- Выбор кухонь -->
            <div class="tw-mb-6" wire:ignore>
                <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Любимые кухни</label>
                <select id="selectedCuisines" 
                    class="form-control select2 tw-w-full" 
                    multiple 
                    data-placeholder="Выберите кухни"
                    wire:model="selectedCuisines">
                    @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}">{{ $cuisine->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Выбор типов заведений -->
            <div class="tw-mb-6" wire:ignore>
                <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Типы заведений</label>
                <select id="selectedTypes" 
                    class="form-control select2 tw-w-full" 
                    multiple 
                    data-placeholder="Выберите типы"
                    wire:model="selectedTypes">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Выбор услуг -->
            <div class="tw-mb-6" wire:ignore>
                <label class="tw-block tw-text-gray-700 tw-font-medium tw-mb-2">Удобства и услуги</label>
                <select id="selectedGeneralInfos" 
                    class="form-control select2 tw-w-full" 
                    multiple 
                    data-placeholder="Выберите услуги"
                    wire:model="selectedGeneralInfos">
                    @foreach($generalInfos as $info)
                        <option value="{{ $info->id }}">{{ $info->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="tw-bg-white tw-rounded-lg tw-shadow tw-p-6 tw-mt-4">
            <h3 class="tw-text-lg tw-font-semibold tw-mb-4">Дополнительные настройки</h3>
            
            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
                <!-- Время посещения -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium">Предпочтительное время посещения</label>
                    <div class="tw-flex tw-gap-2 tw-mt-1">
                        <input type="time" wire:model="preferredTimeFrom" class="tw-border tw-rounded tw-p-2">
                        <input type="time" wire:model="preferredTimeTo" class="tw-border tw-rounded tw-p-2">
                    </div>
                </div>

                <!-- Ценовая категория -->
                <div>
                    <label class="tw-block tw-text-sm tw-font-medium">Ценовая категория</label>
                    <select wire:model="priceCategory" class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-border-gray-300">
                        <option value="низкие" @selected($priceCategory == 'низкие')>Низкая</option>
                        <option value="средние" @selected($priceCategory == 'средние')>Средняя</option>
                        <option value="выше среднего" @selected($priceCategory == 'выше среднего')>Выше средней</option>
                        <option value="высокие" @selected($priceCategory == 'высокие')>Высокая</option>
                    </select>
                </div>

            </div>
        </div>
        <button type="submit" 
            class="tw-mt-4 tw-bg-green-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md hover:tw-bg-green-700">
            Сохранить предпочтения
        </button>
    </form>
</div>
@script()
<script>
                $(document).ready(function() {
                    $('#selectedCuisines').select2({
                        theme: 'bootstrap4'
                    });
                    $('#selectedCuisines').on('change', function(){
                        let data = $(this).val();
                        $wire.selectedCuisines = data;

                    })
                });
                $(document).ready(function() {
                    $('#selectedTypes').select2({
                        theme: 'bootstrap4'
                    });
                    $('#selectedTypes').on('change', function(){
                        let data = $(this).val();
                        $wire.selectedTypes = data;

                    })
                });   
                $(document).ready(function() {
                    $('#selectedGeneralInfos').select2({
                        theme: 'bootstrap4'
                    });
                    $('#selectedGeneralInfos').on('change', function(){
                        let data = $(this).val();
                        $wire.selectedGeneralInfos = data;

                    })
                });  
</script>
@endscript
