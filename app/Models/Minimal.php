<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minimal extends Model
{
    use HasFactory;
    public function investigation(){
        return $this->belongsTo(Investigation::class, 'investigation_id');
    }
    public function receiver(){
        return $this->belongsTo(Personnel::class, 'receiver');
    }
    public function respondingEngine(){
        return $this->belongsTo(Truck::class, 'first_responding_engine');
    }
    public function respondingLeader(){
        return $this->belongsTo(Personnel::class, 'first_responding_leader');
    }
    public function alarm(){
        return $this->belongsTo(Alarm_name::class, 'alarm_status_time');
    }
}
