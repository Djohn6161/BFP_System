<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    public function responses(){
        return $this->hasMany(Response::class, 'engine_dispatched');
    }
    public function minimalEngine(){
        return $this->hasMany(Minimal::class, 'first_responding_engine');
    }
    public static function getByName($name){
        return self::where('name', $name)->first();
    }
}
