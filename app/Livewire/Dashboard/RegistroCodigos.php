<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Codigo;
use App\Models\RegistroCodigo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class RegistroCodigos extends Component
{
    // Models
    public $codigo;

    public function render()
    {
        return view('livewire.dashboard.registro-codigos');
    }

    public function storePuntos(){        
        $this->validate([
            'codigo' => 'required|alpha_num:ascii'
        ]);

        if (RateLimiter::tooManyAttempts('send-message:'.Auth::user()->id, $perMinute = 5)) {
            return $this->addError('codigo-bloqueado', 'Oops, demasiados intentos.');
        }
        RateLimiter::hit('send-message:'.Auth::user()->id);
        
        $codigo = Codigo::where('codigo', 'LIKE', "%$this->codigo%")->first();
        if ($codigo && $codigo->estado_id){
            $registroCodigo = new RegistroCodigo;
            $registroCodigo->codigo_id = $codigo->id;
            $registroCodigo->puntos_sumados = $codigo->referencia->puntos;
            $registroCodigo->user_id = Auth::user()->id;
            $registroCodigo->save();
            
            $codigo->estado_id = 0;
            $codigo->update();

            $user = User::find(Auth::user()->id);
            $user->puntos += $registroCodigo->puntos_sumados;
            $user->update();

            return redirect()->route('dashboard')->with('success-registro-codigo', "Código canjeado con éxito, ganaste $registroCodigo->puntos_sumados puntos.");
        }
        
        return $this->addError('codigo', 'Oops, este código no es válido.');
    }

    public function messages() 
    {
        return [
            'codigo.required' => 'Oops, este código no existe.',
            'codigo.alpha_num' => 'Oops, este código no existe.',
        ]; 
    }
}
  