<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\bbdd_marketplace_general;
 
class Market extends Component
{
    // Useful vars 
    public $premios, $puntosUser, $user, $destacados;

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

        $this->destacados = Premio::select('id', 'nombre', 'descripcion', 'stock', 'puntos', 'foto')->where([
            ['stock', '>', 0],
            ['tipo', 0]
        ])->get();
    }

    public function redimir($premio){ 
        $modelPremio = $this->premios->where('id', $premio)->first();
        
        if ($this->user->puntos < $modelPremio->puntos){
            return $this->addError('redencion', 'Oops, no tienes suficientes puntos para realizar esta redención.');
        }

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

        // registro_budpass
        $marketplace_general = new bbdd_marketplace_general;
        $marketplace_general->nombre = $this->user->name;
        $marketplace_general->correo = $this->user->email;
        $marketplace_general->posicion_ranking = $this->user->rank($this->user->id);
        $marketplace_general->save();

        return redirect()->route('market')->with([
            'title' => 'Redención exitosa.',
            'success-redencion' => '¡Felicidades! haz redimido el premio: '.$this->premios->where('id', $premio)->first()->nombre.', pronto nos contactaremos contigo.'
        ]);
    } 
}
