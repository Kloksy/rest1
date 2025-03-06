<div class="tw-bg-white tw-rounded-lg tw-shadow tw-p-6 tw-mb-6">
    <h3 class="tw-text-xl tw-font-semibold tw-mb-4">Основная информация</h3>
    
    <form wire:submit="save">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-4">
            <!-- Поля ввода -->
            <div class="tw-mt-2">
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Имя</label>
                <input type="text" wire:model="name" 
                    class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm">
            </div>
            
            <!-- Координаты -->
            <div class="tw-mt-2">
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-700">Локация</label>
                <div class="tw-grid tw-grid-cols-2 tw-gap-2">
                    <input type="number" step="0.000001" wire:model="latitude" 
                        placeholder="Широта" class="tw-rounded-md tw-border-gray-300">
                    <input type="number" step="0.000001" wire:model="longitude" 
                        placeholder="Долгота" class="tw-rounded-md tw-border-gray-300">
                </div>
            </div>
        </div>

        <button type="submit" 
            class="tw-mt-4 tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md hover:tw-bg-blue-700">
            Сохранить изменения
        </button>
    </form>
</div>