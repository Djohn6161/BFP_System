<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor_duty_personnel extends Model
{
    use HasFactory;

    public function getPersonnels()
    {
        return $this->hasOne(Personnel::class, 'personnels_id');
    }
}
