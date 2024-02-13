<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroFactura extends Model
{
    use HasFactory;
    protected $table = "registros_factura";
    
    public function productos(){
        return $this->hasMany(ProductoFactura::class, 'factura_id', 'id');
    }

    public function canal(){
        return $this->hasOne(Canal::class, 'id', 'canal_id');
    }

    public function shopper(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
 