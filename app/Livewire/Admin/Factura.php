<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Traits\Mail;

class Factura extends Component
{
    use Mail;
    // Filled 
    public $registroFactura;

    public function render()
    {
        return view('livewire.admin.factura');
    } 

    public function cambioEstado($estado){
        // Validación estado factura
        if ($this->validateFactura()){
            return redirect()->route('facturas')->with('success', "Esta factura ya fue validada.");
        }
        
        $messaje = ($estado) ? "Factura APROBADA con éxito." : "Factura RECHAZADA con éxito.";
        $this->registroFactura->estado_id = $estado;        

        // Update user puntos
        if ($estado){
            $this->registroFactura->shopper->puntos += $this->registroFactura->puntos_sumados;
            $this->registroFactura->shopper->update();
        }
        
        $this->validated($this->registroFactura, $estado);
        
        if ($this->registroFactura->update()){
            return redirect()->route('facturas')->with('success', $messaje);
        }

        return redirect()->route('facturas')->withErrors('Oops, algo salió mal.');
    }

    public function validateFactura(){
        if ($this->registroFactura->estado_id != 2){
            return true;
        }

        return false;
    }
}
 