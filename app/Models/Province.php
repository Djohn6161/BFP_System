<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public function municipalities(){
        return $this->hasMany(Municipality::class, 'municipalities_id');
    }
}
