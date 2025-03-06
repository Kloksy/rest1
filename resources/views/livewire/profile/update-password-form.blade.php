<div class="tw-bg-white tw-rounded-lg tw-shadow tw-p-6 tw-mt-6">
    <h3 class="tw-text-xl tw-font-semibold tw-mb-4">Смена пароля</h3>
    
    <form wire:submit="save">
        <div class="tw-space-y-4">
            <!-- Текущий пароль -->
            <div>
                <label class="tw-block tw-text-sm tw-font-medium">Текущий пароль</label>
                <input type="password" wire:model="current_password" 
                    class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-border-gray-300">
                @error('current_password') <span class="tw-text-red-500 tw-text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Новый пароль -->
            <div>
                <label class="tw-block tw-text-sm tw-font-medium">Новый пароль</label>
                <input type="password" wire:model="new_password" 
                    class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-border-gray-300">
                @error('new_password') <span class="tw-text-red-500 tw-text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Подтверждение -->
            <div>
                <label class="tw-block tw-text-sm tw-font-medium">Подтвердите пароль</label>
                <input type="password" wire:model="new_password_confirmation" 
                    class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-border-gray-300">
            </div>
        </div>

        <button type="submit" 
            class="tw-mt-4 tw-bg-blue-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-md hover:tw-bg-blue-700">
            Обновить пароль
        </button>
    </form>
</div>
