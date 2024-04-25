<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlarmName extends Model
{
    use HasFactory;
    public function afor(){
        return $this->belongsTo(Afor::class,'afor_id');
    }
    public function personnel(){
        return $this->belongsTo(Personnel::class,'personnels_id');
    }
}