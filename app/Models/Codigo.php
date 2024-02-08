<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    use HasFactory;
    protected $table = "codigos";

    public function referencia(){
        return $this->hasOne(Referencia::class, 'id', 'referencia_id');
    }
}
