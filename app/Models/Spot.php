<?php

namespace App\Models;

use App\Models\Progress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spot extends Model
{
    use HasFactory;
    
    public function investigation(){
        return $this->belongsTo(Investigation::class, 'investigation_id');
    }
    public function progress(){
        return $this->hasOne(Progress::class, 'spot_id');
    }
    public function final(){
        return $this->hasOne(Ifinal::class, 'spot_id');
    }
    public function alarmed(){
        return $this->belongsTo(Alarm_name::class, 'alarm');
    }
    public function afor(){
        return $this->belongsTo(Afor::class, 'afor_id');
    }
    
}
