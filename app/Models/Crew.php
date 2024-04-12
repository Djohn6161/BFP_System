<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    public function report(){
        $this->belongsTo(Report::class, 'report_id');
    }

    public function personnel(){
        $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
