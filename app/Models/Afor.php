<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor extends Model
{
    // protected $table = 'afors';
    // protected $fillable = [
    //     'alarm_received',
    //     'transmitted_by',
    //     'caller_address',
    //     'received_by',
    //     'barangay_id',
    //     'zone',
    //     'td_under_control',
    //     'td_declared_fireout',
    //     'occupancy',
    //     'occupancy_specify',
    //     'distance_to_fire_incident',
    //     'structure_description',
    //     'sketch_of_fire_operation',
    //     'details',
    //     'problem_encounter',
    //     'observation_recommendation',
    //     'alarm_status_arrival',
    //     'first_responder',
    // ];

    public function transmittedBy(){
        return $this->belongsTo(Personnel::class, 'transmitted_by');
    }

    public function receivedBy(){
        return $this->belongsTo(Personnel::class, 'received_by');
    }

    public function personRank($id){
        return Rank::where('id', $id)->first();
    }

    public function aforLogs(){
        return $this->hasMany(AforLog::class, 'afor_id');
    }
    public function casualties(){
        return $this->hasMany(Afor_casualties::class, 'afor_id');
    }
    public function declaredAlarms(){
        return $this->hasMany(Declared_alarm::class, 'afor_id');
    }
    public function alarmStatus(){
        return $this->hasMany(Alarm_status::class, 'afor_id');
    }
    public function usedEquipments(){
        return $this->hasMany(Used_equipment::class, 'afor_id');
    }
    public function responses(){
        return $this->hasMany(Response::class, 'afor_id');
    }
    public function dutyPersonnel(){
        return $this->belongsTo(Duty_personnel::class,'afor_id');
    }

    public function personnel(){
        $this->belongsTo(Personnel::class, 'personnel_id');
    }

}
