<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brgy_reports extends Model
{
    use HasFactory;
    public function report(){
        return $this->belongsTo(Report::class, 'report_id');
    }
    public function Barangay(){
        return $this->belongsTo(Barangay::class, 'brgy_id');
    }
}
