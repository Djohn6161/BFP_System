<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;
    
    public function Investigation(){
        return $this->belongsTo(Investigation::class, 'investigation_id');
    }
    public function Progress(){
        return $this->hasMany(Progress::class, 'spot_id');
    }
    public function final(){
        return $this->hasMany(Ifinal::class, 'spot_id');
    }
}
