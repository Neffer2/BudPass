<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Premio;
use App\Models\Redencion;
 
class Market extends Component
{
    // Useful vars 
    public $premios, $puntosUser, $user;

    public function render()
    {
        return view('livewire.dashboard.market');
    }

    public function mount(){
        $this->user = Auth::user(); 
        $this->puntosUser = $this->user->puntos; 
        $this->premios = Premio::select('id', 'nombre', 'descripcion', 'stock', 'puntos', 'foto')->where([
            ['stock', '>', 0],
            ['tipo', 1]
        ])->get();
    }

    public function redimir($premio){
        $modelPremio = $this->premios->where('id', $premio)->first();

        // Redencion
        $redencion = new Redencion;
        $redencion->premio_id = $modelPremio->id;
        $redencion->user_id = $this->user->id;
        $redencion->save();

        // Puntos user
        $this->user->puntos -= $modelPremio->puntos;
        $this->user->update();

        // Stock premio
        $modelPremio->stock -= 1;
        $modelPremio->update();

        return redirect()->route('market')->with([
            'title' => 'Redención exitosa.',
            'success' => '¡Felicidades! haz redimido el premio: '.$this->premios->where('id', $premio)->first()->nombre.', pronto nos contactaremos contigo.'
        ]);
    }
}
