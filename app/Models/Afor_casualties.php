<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor_casualties extends Model
{
    protected $title = 'afor_casulaties'; 
    
    use HasFactory;

    public function afor(){
        return $this->belongsTo(Afor::class, 'afor_id');
    }
}
