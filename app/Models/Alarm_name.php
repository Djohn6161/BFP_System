<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarm_name extends Model
{
    use HasFactory;
    public function afor(){
        return $this->belongsTo(Afor::class,'afor_id');
    }
    // public function personnel(){
    //     return $this->belongsTo(Personnel::class,'personnels_id');
    // }
    public function minimals(){
        return $this->hasMany(Minimal::class, 'alarm_status_time');
    }
    public function spots(){
        return $this->hasMany(Spot::class, 'alarm');
    }
}
