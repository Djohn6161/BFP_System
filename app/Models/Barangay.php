<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    public function report(){
        return $this->hasOne(Brgy_reports::class, 'brgy_id');
    }
}
