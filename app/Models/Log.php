<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public function report(){
        return $this->belongsTo(Report::class, 'reports_id');
    }
    public function personnel(){
        return $this->belongsTo(Personnel::class, 'personnels_id');
    }
}
