<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    public function department(){
        return $this->BelongsTo(Department::class, 'departments_id');
    }
    public function personnel(){
        return $this->hasMany(Personnel::class, 'personnels_id');
    }
}
