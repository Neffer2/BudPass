<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;
    protected $table = 'canales';

    public function productos(){
        return $this->hasMany(Producto::class, 'canal_id', 'id');
    }
}
