<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\bbdd_registro_budpass;
 
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


        $registros_factura = $this->user->registrosFactura->map(function ($registro){
            return $registro->num_factura;
        });

        $numeros_nit = $this->user->registrosFactura->map(function ($registro){
            return $registro->canal->nit;
        });

        $codigos_redimidos = $this->user->registrosCodigo->map(function ($registro){
            return $registro->codigo->codigo;
        });

        $redenciones = $this->user->redenciones->map(function ($redencion){
            return $redencion->premio->nombre;
        });

        // Store BUD TABLE
        $registro = new bbdd_registro_budpass();
        $registro->nombre = $this->user->name;
        $registro->correo = $this->user->email;
        $registro->fecha_nacimiento = $this->user->fecha_nacimiento;
        $registro->ciudad = $this->user->ciudad->descripcion;
        $registro->numero_factura = $registros_factura->toJson();
        $registro->numero_nit = $numeros_nit->toJson();
        $registro->codigos_redimidos = $codigos_redimidos->toJson();
        $registro->puntaje_acumulado = $this->user->puntos;
        $registro->premios_redimidos = $redenciones->toJson();
        $registro->puesto_ranking = $this->user->rank($this->user->id);
        $registro->save();
        // 

        return redirect()->route('market')->with([
            'title' => 'Redención exitosa.',
            'success-redencion' => '¡Felicidades! haz redimido el premio: '.$this->premios->where('id', $premio)->first()->nombre.', pronto nos contactaremos contigo.'
        ]);
    }   
}
