<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    use HasFactory;

    public function investigation(){
        return $this->belongsTo(Investigation::class, 'investigation_id');
    }

}
