<?php

namespace App\Livewire\Dashboard\Registro;

use Livewire\Component;
use App\Models\RegistroCodigo;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

class HistorialRegistrosCodigo extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $registrosCodigo = RegistroCodigo::select('id', 'codigo_id', 'puntos_sumados')->where('user_id', Auth::user()->id)->paginate(2);
        return view('livewire.dashboard.registro.historial-registros-codigo', ['registrosCodigo' => $registrosCodigo]);
    }
}
