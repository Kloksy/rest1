<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordForm extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    protected function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => [
                'required',
                Password::min(8)
                    ->numbers(),
                'confirmed'
            ]
        ];
    }

    public function save()
    {
        $this->validate();

        auth()->user()->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset();
        $this->dispatch('password-updated', 
            type: 'success',
            message: 'Пароль успешно изменен!'
        );
    }

    public function render()
    {
        return view('livewire.profile.update-password-form');
    }
}