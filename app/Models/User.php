<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
}
