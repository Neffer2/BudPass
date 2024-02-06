<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Http\Requests\Auth\LoginRequest;

class Login extends Component
{   
    // Models
    public $emailLogin, $passwordLive;

    public function render()
    {
        return view('livewire.auth.login');
    }

    // Updates
    public function updatedEmailLogin(){
        $this->validate([
            'emailLogin' => ['required', 'string', 'email']
        ]);
    }

    public function updatedPassword(){
        $this->validate([
            'passwordLive' => ['required', 'string']
        ]);
    }
}
  