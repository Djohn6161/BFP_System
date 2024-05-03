<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casualty extends Model
{
    use HasFactory;

    public function afor(){
        return $this->belongsTo(Afor::class, 'afor_id');
    }
}
