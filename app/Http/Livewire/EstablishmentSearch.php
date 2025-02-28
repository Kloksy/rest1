<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Establishment;
use App\Models\Cuisine;
use App\Models\GeneralInfo;
use App\Models\EstablishmentType;

class EstablishmentSearch extends Component
{
    public $name = ''; // Название заведения
    public $type_id = null; // ID типа заведения
    public $cuisine_ids = []; // Массив ID любимых кухонь
    public $price_category = null; // Ценовая категория
    public $general_info_ids = []; // Массив ID дополнительных услуг
    protected $listeners = ['refreshSelect2' => '$refresh'];

    public function search()
    {        
        
    }

    public function render()
    {
        // Фильтрация заведений на основе введенных данных
        $establishments = Establishment::query();

        if ($this->name) {
            $establishments->where('name', 'like', '%' . $this->name . '%');
        }

        if ($this->type_id) {
            $establishments->where('type_id', $this->type_id);
        }

        if (!empty($this->cuisine_ids)) {
            $establishments->whereHas('cuisines', function ($q) {
                $q->whereIn('id', $this->cuisine_ids);
            });
        }

        if ($this->price_category) {
            $establishments->where('price_category', $this->price_category);
        }

        if (!empty($this->general_info_ids)) {
            $establishments->whereHas('generalInfos', function ($q) {
                $q->whereIn('id', $this->general_info_ids);
            });
        }

        // Получаем результаты
        $establishments = $establishments->paginate(10);

        // Подгружаем данные для фильтров
        $types = EstablishmentType::all();
        $cuisines = Cuisine::all();
        $generalInfos = GeneralInfo::all();

        return view('livewire.establishment-search', [
            'establishments' => $establishments,
            'types' => $types,
            'cuisines' => $cuisines,
            'generalInfos' => $generalInfos,
        ]);
    }
}
