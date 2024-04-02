<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public function personnel(){
        return $this->belongsTo(Personnel::class, 'personnels_id');
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class, 'barangays_id');
    }
    public function logs(){
        return $this->hasMany(Log::class, 'reports_id');
    }
}
