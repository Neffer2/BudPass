<?php

namespace App\Livewire\Dashboard; 

use Livewire\Component;
use App\Models\Canal;

class RegistroFacturas extends Component
{
    // Models
    public $nit, $num_factura, $producto, $cantidad, $puntos = 0;
 
    // Useful vars
    public $canal, $productos;

    public function render()
    {
        $this->getPuntos();
        return view('livewire.dashboard.registro-facturas');
    }

    public function mount(){
        $this->productos = collect();
    }

    /*
        |---------------------------------------
        | Store products on $this->productos
        |---------------------------------------
    */
    public function addProduct(){
        $this->validate([
            'producto' => 'required|numeric',
            'cantidad' => 'required|numeric'
        ]);

        $producto = $this->canal->productos->find($this->producto);
        $this->productos->push(['id' => $producto->id, 'descripcion' => $producto->descripcion, 'cantidad' => $this->cantidad]);
    }

    /*
        |---------------------------------------
        | Subtract products from $this->productos
        |---------------------------------------
    */
    public function subsProduct($key){
        $this->productos->forget($key);
    }

    /*
        |---------------------------------------
        | Calculate points from the bill
        |---------------------------------------
    */
    public function getPuntos(){
        $puntos = 0;
        $this->productos->map(function ($producto) use (&$puntos){
            $puntos += ($this->canal->productos->find($producto['id'])->referencia->puntos) * $producto['cantidad'];
        });
        $this->puntos = $puntos; 
    }
    
    // UPDATES    
    public function updatedNit(){
        $this->validate([
            'nit' => 'required|alpha_dash'
        ]);
        
        $this->canal = Canal::where('nit', 'LIKE', "%$this->nit%")->first();
        // ($this->canal) ? $this->nit = $this->canal->nit : $this->nit = null;
    }   

    public function updatedNumFactura (){
        $this->validate([
            'num_factura' => 'required|numeric|unique:registros_factura|max_digits:15'
        ]);        
    }
} 
