<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Buscar extends Component
{
    // Models
    public $documento, $telefono, $email;

    // Useful vars
    public $user = [];

    public function render()
    {   
        return view('livewire.admin.buscar');
    }

    public function search(){
        $filters = [];

        if ($this->documento){
            array_push($filters, ['documento', 'LIKE', "%$this->documento%"]);
        }

        if ($this->telefono){
            array_push($filters, ['telefono', 'LIKE', "%$this->telefono%"]);
        }

        if ($this->email){
            array_push($filters, ['email', 'LIKE', "%$this->email%"]);
        }

        $this->user = User::select('id', 'name', 'documento', 'telefono', 'ciudad_id', 'email', 'puntos')->where($filters)->first();
    }

}
