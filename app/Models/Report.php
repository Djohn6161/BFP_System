<?php

namespace App\Models;

use App\Models\Rank;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    public function teamLeader(){
        return $this->belongsTo(Personnel::class, 'team_leaders_id');
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangays_id');
    }
    public function logs(){
        return $this->hasMany(Log::class, 'reports_id');
    }
    public function driver(){
        return $this->belongsTo(Personnel::class, 'drivers_id');
    }

    public function truck(){
        return $this->belongsTo(Truck::class, 'trucks_id');
    }
    public function victims(){
        return $this->hasMany(Victim::class, 'report_id');
    }
    public function crews(){
        return $this->hasMany(Crew::class, 'report_id');
    }
    public function personRank($id){
        return Rank::where('id', $id)->first();
    }
}
