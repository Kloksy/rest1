<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Cuisine;
use App\Models\GeneralInfo;
use App\Models\EstablishmentType;
use App\Models\UserPreference;

class UpdatePreferencesForm extends Component
{
    public array $selectedCuisines = [];
    public array $selectedTypes = [];
    public array $selectedGeneralInfos = [];
    public $preferredTimeFrom;
    public $preferredTimeTo;
    public $priceCategory;
    
    protected $listeners = ['select2-updated' => 'handleSelect2Update'];

    public function mount()
    {
        $user = auth()->user();
        
        // Основные предпочтения
        $this->selectedCuisines = $user->cuisines->pluck('id')->toArray();
        $this->selectedTypes = $user->establishmentTypes->pluck('id')->toArray();
        $this->selectedGeneralInfos = $user->generalInfos->pluck('id')->toArray();

        //Настройки из user_preferences
        if ($user->userPreferences) {
            $this->preferredTimeFrom = $user->userPreferences?->preferred_time_from;
            $this->preferredTimeTo = $user->userPreferences?->preferred_time_to;
            $this->priceCategory = $user->userPreferences?->price_category;
        }
    }

    public function save()
    {
        $user = auth()->user();
        dump($this->selectedCuisines);
        // Сохраняем связи Many-to-Many
        $user->cuisines()->sync($this->selectedCuisines);
        $user->establishmentTypes()->sync($this->selectedTypes);
        $user->generalInfos()->sync($this->selectedGeneralInfos);

        // Сохраняем настройки в user_preferences
        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'preferred_time_from' => $this->preferredTimeFrom,
                'preferred_time_to' => $this->preferredTimeTo,
                'price_category' => $this->priceCategory,
            ]
        );

        $this->dispatch('preferences-updated', message: 'Настройки успешно сохранены!');
    }
    
    public function handleSelect2Update($payload)
    {
        if ($payload['model'] === 'selectedCuisines') {
            $this->selectedCuisines = $payload['value'];
        } elseif ($payload['model'] === 'selectedTypes') {
            $this->selectedTypes = $payload['value'];
        } elseif ($payload['model'] === 'selectedGeneralInfos') {
            $this->selectedGeneralInfos = $payload['value'];
        }
    }

    public function render()
    {
        return view('livewire.profile.update-preferences-form', [
            'cuisines' => Cuisine::all(),
            'types' => EstablishmentType::all(),
            'generalInfos' => GeneralInfo::all()
        ]);
    }
}
