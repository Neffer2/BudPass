<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redencion extends Model
{
    use HasFactory;
    protected $table = 'redenciones';

    public function premio(){
        return $this->hasOne(Premio::class, 'id', 'premio_id');
    }
}
