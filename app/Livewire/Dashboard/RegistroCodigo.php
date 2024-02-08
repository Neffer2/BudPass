<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Codigo;
use App\Models\RegistrosCodigo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistroCodigo extends Component
{
    // Models
    public $codigo;

    public function render()
    {
        return view('livewire.dashboard.registro-codigo');
    }

    public function storePuntos(){
        $this->validate([
            'codigo' => 'required|alpha_num:ascii' 
        ]);

        $codigo = Codigo::where('codigo', 'LIKE', "%$this->codigo%")->first();
        if ($codigo && $codigo->estado_id){
            $registroCodigo = new RegistrosCodigo;
            $registroCodigo->codigo_id = $codigo->id;
            $registroCodigo->puntos_sumados = $codigo->referencia->puntos;
            $registroCodigo->user_id = Auth::user()->id;
            $registroCodigo->save();
            
            $codigo->estado_id = 0;
            $codigo->update();

            $user = User::find(Auth::user()->id);
            $user->puntos += $registroCodigo->puntos_sumados;
            $user->update();

            return redirect()->route('dashboard')->with('success', "Código canjeado con éxito, ganaste $registroCodigo->puntos_sumados puntos.");
        }        
        return $this->addError('codigo', 'Opps, este código ya fué canjeado.');
    }

    public function messages() 
    {
        return [
            'codigo.required' => 'Opps, este código no existe.',
            'codigo.alpha_num' => 'Opps, este código no existe.',
        ]; 
    }
}
  