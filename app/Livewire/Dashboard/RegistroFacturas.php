<?php

namespace App\Livewire\Dashboard; 

use Livewire\Component;
use App\Models\Canal;

class RegistroFacturas extends Component
{
    // Models
    public $nit, $num_factura, $producto, $cantidad;
 
    // Useful vars
    public $canal, $productos = [];

    public function render()
    {
        return view('livewire.dashboard.registro-facturas');
    }

    public function addProduct(){
        array_push($this->productos, ['id' => $this->producto, 'descripcion' => 'descripcion', 'cantidad' => $this->cantidad]);
        $this->productos = $this->productos;
    }
    
    // UPDATES    
    public function updatedNit(){
        $this->validate([
            'nit' => 'required|numeric'
        ]);
        
        $this->canal = Canal::where('nit', 'LIKE', "%$this->nit%")->first();
    }   

    public function updatedNumFactura (){
        $this->validate([
            'num_factura' => 'required|numeric|unique:registros_factura|max_digits:15'
        ]);        
    }
} 
