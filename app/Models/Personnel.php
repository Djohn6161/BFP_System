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
        $data = explode(' ',$name);
        // dd($data);
        if (count($data) >= 3) {
            $rankName = $data[0];
            $lastName = rtrim($data[1], ','); // Remove the trailing comma from the last name
            $firstNames = implode(' ', array_slice($data, 2)); // Join the remaining elements to form the first name(s)
        } else {
            // Handle error for insufficient data elements
            throw new Exception('Insufficient data elements');
        }
        
        // Now you can use these variables in your query
        return self::whereHas('rank', function ($query) use ($rankName) {
            $query->where('slug', $rankName);
        })
        ->where('last_name', $lastName)
        ->where('first_name', $firstNames)
        ->first();
        
        // dd($personnel);
        // $rankName = $data[0];
        // $lastName = array_pop($data);
        // $firstNames = implode(' ', array_slice($data, 1));
        // $personnel = Personnel::whereHas('rank', function ($query) use ($rankName) {
        //     $query->where('slug', $rankName);
        // })
        // // ->where('first_name', $firstNames)
        // // ->where('last_name', $lastName)
        // ->get();
        // $rank = $details[0];
        // $last

    }

}
