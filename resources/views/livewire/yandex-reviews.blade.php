<div>
    <div class="tw-flex tw-items-center tw-space-x-4">
        <!-- Выбор поля -->
        <div class="tw-relative">
            <select wire:model="sortField" 
                    wire:change="sortBy($event.target.value)"
                    class="tw-appearance-none tw-bg-white tw-border tw-border-gray-300 tw-rounded-lg tw-py-2 tw-px-4 tw-pr-8">
                @foreach($sortableFields as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Кнопка направления -->
        <button wire:click="changeSortDirection" 
                class="tw-p-2 tw-rounded-lg tw-border tw-border-gray-300 hover:tw-bg-gray-50">
            @if($sortDirection === 'asc')
                <i class="fas fa-sort-amount-up-alt"></i>
            @else
                <i class="fas fa-sort-amount-down-alt"></i>
            @endif
        </button>
    </div>
    @forelse($reviews as $review)
        <div class="tw-card tw-mb-3">
            <div class="tw-card-body">
                <div class="tw-flex tw-items-start tw-mb-3">
                    <div class="tw-flex-1">
                        <div class="tw-flex tw-items-center tw-mb-2">
                            <div class="tw-w-8 tw-h-8 tw-bg-blue-500 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-white tw-mr-3">
                                        {{ strtoupper(substr($review->user_name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="tw-font-semibold">{{ $review->user_name }}</h5>
                                <div class="tw-text-sm tw-text-gray-500">
                                            {{ $review->created_at->format('d.m.Y H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="tw-flex tw-items-center tw-mb-2">
                            <div class="tw-star-rating"> {{$review->rating}}⭐</div>
                        </div>
                        <p class="tw-text-gray-700">{{ $review->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        @empty
        <div class="tw-text-center tw-py-6">
            Нет отзывов с Яндекс Карт
        </div>
        @endforelse

        @if($reviews->hasPages())
        <div class="tw-mt-4">
            {{ $reviews->links() }}
        </div>
    @endif
</div>

@push('style')
<style>
[wire\:model="sortField"] option:checked {
    @apply tw-font-semibold tw-bg-blue-50;
}

/* Анимация для иконок сортировки */
.fa-sort-amount-up, .fa-sort-amount-down {
    @apply tw-transition-transform tw-duration-200;
}

button:hover .fa-sort-amount-up {
    @apply tw-translate-y-[-2px];
}

button:hover .fa-sort-amount-down {
    @apply tw-translate-y-[2px];
}    
</style>
@endpush
