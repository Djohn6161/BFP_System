<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minimal extends Model
{
    use HasFactory;
    public function Investigation(){
        return $this->belongsTo(Investigation::class, 'investigation');
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
}
