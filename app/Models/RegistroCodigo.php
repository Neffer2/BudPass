<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCodigo extends Model
{
    use HasFactory;
    protected $table = 'registros_codigo';

    public function codigo(){
        return $this->hasOne(Codigo::class, 'id', 'codigo_id');
    }
}
