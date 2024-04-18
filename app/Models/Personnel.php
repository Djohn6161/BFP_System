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
    public function driverReport(){
        return $this->hasMany(Personnel::class, 'drivers_id');
    }
    public function teamLeaderReport(){
        return $this->hasMany(Personnel::class, 'team_leaders_id');
    }
    // public function crewReport(){
    //     return $this->hasMany(Crew::class, 'personnel_id');
    // }
}
