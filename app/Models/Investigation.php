<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;
    public function Minimal(){
        return $this->hasMany(Minimal::class, 'investigation_id');
    }
    public function Spot(){
        return $this->hasMany(Spot::class, 'investigation_id');
    }
    public function progress(){
        return $this->hasMany(Progress::class, 'investigation_id');
    }
    public function final(){
        return $this->hasMany(Ifinal::class, 'investigation_id');
    }
    public function Casualties(){
        return $this->hasMany(Investigation_casualties::class, 'investigations_id');
    }
}
