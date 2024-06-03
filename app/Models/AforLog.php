<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AforLog extends Model
{
    use HasFactory;

    public function afor(){
        return $this->belongsTo(Afor::class, 'afor_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
