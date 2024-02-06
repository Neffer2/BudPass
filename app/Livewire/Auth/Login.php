<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{   
    // Models
    public $emailLogin, $passwordLive;

    public function render()
    {
        return view('livewire.auth.login');
    }
}
  