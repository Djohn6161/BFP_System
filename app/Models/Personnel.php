<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    public function department(){
        return $this->BelongsTo(Department::class, 'departments_id');
    }
    public function rank(){
        return $this->belongsTo(Rank::class, 'ranks_id');
    }
    public function aforTransmitted(){
        return $this->hasMany(Afor::class, 'transmitted_by');
    }
    public function alarmCommand(){
        return $this->hasMany(Declared_alarm::class, 'ground_commander');
    }
    public function aforDuty(){
        return $this->hasMany(Duty_personnel::class, 'personnels_id');
    }
}
