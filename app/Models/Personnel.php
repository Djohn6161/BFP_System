<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->BelongsTo(Department::class, 'departments_id');
    }
    public function rank()
    {
        return $this->belongsTo(Rank::class, 'ranks_id');
    }
    public function aforTransmitted()
    {
        return $this->hasMany(Afor::class, 'transmitted_by');
    }
    public function aforReceived()
    {
        return $this->hasMany(Afor::class, 'received_by');
    }
    public function minimalReceived()
    {
        return $this->hasMany(Minimal::class, 'receiver');
    }
    public function minimalLeader()
    {
        return $this->hasMany(Minimal::class, 'first_responding_leader');
    }
    public function alarmCommand()
    {
        return $this->hasMany(Declared_alarm::class, 'ground_commander');
    }
    public function aforDuty()
    {
        return $this->hasMany(Afor_duty_personnel::class, 'personnels_id');
    }

    public function designations()
    {
        return $this->hasMany(Personnel_designation::class, 'personnel_id');
    }

    public function tertiaries()
    {
        return $this->hasMany(Tertiary::class, 'personnel_id');
    }

    public function courses()
    {
        return $this->hasMany(Post_graduate_course::class, 'personnel_id');
    }
    public static function getByName($name){
        $details = explode(' ',$name);
        $rank = $details[0]
        dd($details);

    }

}
