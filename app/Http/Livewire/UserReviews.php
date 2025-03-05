<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Establishment;

class UserReviews extends Component
{
    use WithPagination;
    
    public $establishment;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $sortableFields = [
        'rating' => 'Рейтинг',
        'created_at' => 'Дата'
    ];

    protected function rules()
    {
        return [
            'sortDirection' => ['required', 'in:asc,desc'],
            'sortField' => ['required', 'in:' . implode(',', array_keys($this->sortableFields))],
        ];
    }

    public function mount(Establishment $establishment)
    {
        $this->establishment = $establishment;
    }

    protected $queryString = [
        'sortField' => ['except' => 'created_at', 'as' => 'sort'],
        'sortDirection' => ['except' => 'desc', 'as' => 'dir'],
        'perPage' => ['except' => 10]
    ];

    protected $listeners = ['tabChanged' => 'handleTabChange'];

    public function handleTabChange($tab)
    {
        if(($tab === '#yandex-reviews' && $this instanceof YandexReviews) ||
        ($tab === '#user-reviews' && $this instanceof UserReviews)) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.user-reviews', [
            'reviews' => $this->establishment->userReviews()
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
            'sortableFields' => $this->sortableFields
        ]);
    }
    
    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    public function sortBy($field)
    {
        // Валидация допустимых полей
        if (!array_key_exists($field, $this->sortableFields)) {
            return;
        }
        
        // Если поле уже выбрано - меняем направление
        if ($this->sortField === $field) {
            $this->changeSortDirection();
        } else {
            // Если новое поле - сбрасываем направление
            $this->sortDirection = 'desc';
            $this->sortField = $field;
            $this->resetPage();
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }
}
