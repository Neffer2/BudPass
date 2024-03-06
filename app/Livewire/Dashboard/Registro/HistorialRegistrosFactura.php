<?php

namespace App\Livewire\Dashboard\Registro;

use Livewire\Component; 
use App\Models\RegistroFactura;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

class HistorialRegistrosFactura extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render() 
    {
        $registrosFactura = RegistroFactura::select('id', 'num_factura', 'canal_id', 'puntos_sumados', 'estado_id')->where('user_id', Auth::user()->id)->paginate(2);
        return view('livewire.dashboard.registro.historial-registros-factura', ['registrosFactura' => $registrosFactura]);
    }
}