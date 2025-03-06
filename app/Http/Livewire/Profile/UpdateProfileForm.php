<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Validation\Rule;

class UpdateProfileForm extends Component
{
    public $name;
    public $email;
    public $latitude;
    public $longitude;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->latitude = auth()->user()->latitude;
        $this->longitude = auth()->user()->longitude;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180'
        ]);

        auth()->user()->update($validated);
        
        $this->dispatch('profile-updated', 
            message: 'Профиль успешно обновлен!'
        );
    }

    public function render()
    {
        return view('livewire.profile.update-profile-form');
    }
}
