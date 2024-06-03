<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation_casualties extends Model
{
    use HasFactory;
    public function investigation(){
        return $this->belongsTo(Investigation::class, 'investigations_id');
    }
    
}
