<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor extends Model
{
    use HasFactory;

    public function aforLogs(){
        return $this->hasMany(AforLog::class, 'afor_id');
    }
    public function casualties(){
        return $this->hasMany(Casualty::class, 'afor_id');
    }
    public function declaredAlarms(){
        return $this->hasMany(Declared_alarm::class, 'afor_id');
    }
    public function usedEquipments(){
        return $this->hasMany(Used_equipment::class, 'afor_id');
    }
    public function responses(){
        return $this->hasMany(Response::class, 'afor_id');
    }
    public function transmittedBy(){
        return $this->belongsTo(Personnel::class, 'afor_id');
    }
    public function dutyPersonnel(){
        return $this->belongsTo(Duty_personnel::class,'afor_id');
    }

}
