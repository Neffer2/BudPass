<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'documento',
        'telefono',
        'ciudad_id',
        'fecha_nacimiento', 
        'email',
        'password',
        'terminos',
        'politicas',
        'tratamiento',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ]; 
 
    public function registrosFactura(){
        return $this->hasMany(RegistroFactura::class, 'user_id', 'id');
    }

    public function registrosCodigo(){
        return $this->hasMany(RegistroCodigo::class, 'user_id', 'id');
    }

    public function redenciones(){
        return $this->hasMany(Redencion::class, 'user_id', 'id');
    }
 
    public function ciudad(){
        return $this->hasOne(Ciudad::class, 'id', 'ciudad_id');
    }

    public function pendientes($user_id){
        $pendientes = RegistroFactura::select('puntos_sumados')->where([
            ['estado_id', 2],
            ['user_id', $user_id]
        ])->get();

        return $pendientes->sum('puntos_sumados');
    }

    public function rank($id){
        $user_rank = User::select('id', 'name', 'email', 'puntos')->where('puntos', '>', $id)->count();
        return $user_rank;
    }

    public function limite($puntos_suamdos){
        $registrosFactura = RegistroFactura::where([
                            ['created_at', '>=', Carbon::now()->subDay()],
                            ['estado_id', '!=', 0],
                            ['user_id', Auth::user()->id],
                        ])->sum('puntos_sumados');

        $registrosCodigo = RegistroCodigo::where([
                        ['created_at', '>=', Carbon::now()->subDay()],
                        ['user_id', Auth::user()->id],
                    ])->sum('puntos_sumados');
                    
        if (($registrosFactura + $registrosCodigo + $puntos_suamdos) > 450){ return false; }
        return true;
    }
}
