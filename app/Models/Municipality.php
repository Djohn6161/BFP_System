<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    public function barangays(){
        return $this->hasMany(Barangay::class, 'barangays_id');
    }
    public function province(){
        return $this->belongTo(Province::class, 'provinces_id');
    }
}
