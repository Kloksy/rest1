<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class ShowProfile extends Component
{
    public function render()
    {
        return view('livewire.profile.show-profile')
        ->layout('layouts.app');
    }
}
