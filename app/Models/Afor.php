<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor extends Model
{
    public function transmittedBy()
    {
        return $this->belongsTo(Personnel::class, 'transmitted_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo(Personnel::class, 'received_by');
    }

    public function personRank($id)
    {
        return Rank::where('id', $id)->first();
    }

    public function aforLogs()
    {
        return $this->hasMany(AforLog::class, 'afor_id');
    }
    public function casualties()
    {
        return $this->hasMany(Afor_casualties::class, 'afor_id');
    }
    public function declaredAlarms()
    {
        return $this->hasMany(Declared_alarm::class, 'afor_id');
    }
    public function alarmStatus()
    {
        return $this->hasMany(Declared_alarm::class, 'afor_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'afor_id');
    }
    public function dutyPersonnel()
    {
        return $this->belongsTo(Afor_duty_personnel::class, 'afor_id');
    }
    public function getOccupancy()
    {
        return $this->hasOne(Occupancy::class, 'afor_id');
    }
    public function getBreathingApparatus()
    {
        return $this->hasMany(Used_equipment::class, 'afor_id')->where('category', 'breathing apparatus');
    }
    public function getExtinguishingAgent()
    {
        return $this->hasMany(Used_equipment::class, 'afor_id')->where('category', 'extinguishing agent');
    }
    public function getRopeAndLadder()
    {
        return $this->hasMany(Used_equipment::class, 'afor_id')->where('category', 'rope and ladder');
    }
    public function getHoseLine()
    {
        return $this->hasMany(Used_equipment::class, 'afor_id')->where('category', 'hose line');
    }

    public function personnel()
    {
        $this->belongsTo(Personnel::class, 'personnel_id');
    }

}
