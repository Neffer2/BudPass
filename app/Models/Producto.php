<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    public function referencia(){
        return $this->hasOne(Referencia::class, 'id', 'referencia_id');
    }
}
