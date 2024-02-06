<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Canal;

class RegistroFacturas extends Component
{
    // Models
    public $nit;

    // Useful vars
    public $canal;

    public function render()
    {
        return view('livewire.dashboard.registro-facturas');
    }

    public function mount(){
        $this->canal = collect();
    }
    
    public function updatedNit(){
        // $this->reset('canal');
        $this->validate([
            'nit' => 'required|numeric'
        ]);
        
        $this->canal = collect(Canal::where('nit', 'LIKE', "%$this->nit%")->first());
    }   
} 
