<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Factura extends Component
{
    // Filled
    public $registroFactura;

    public function render()
    {
        return view('livewire.admin.factura');
    }

    public function cambioEstado($estado){
        $messaje = ($estado) ? "Factura APROBADA con éxito." : "Factura RECHAZADA con éxito.";
        $this->registroFactura->estado_id = $estado;

        if ($this->registroFactura->update()){
            return redirect()->route('facturas')->with('success', $messaje);
        }

        return redirect()->route('facturas')->withErrors('Oops, algo salió mal.');
    }
}
