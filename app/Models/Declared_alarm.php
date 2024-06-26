<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declared_alarm extends Model
{
    use HasFactory;

    public function afor(){
        return $this->belongsTo(Afor::class, 'afor_id');
    }
    public function getgroundCommander(){
        return $this->belongsTo(Personnel::class, 'ground_commander');
    }
}
