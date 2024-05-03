<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progresses';
    use HasFactory;
    public function spot(){
        return $this->belongsTo(Spot::class, 'spot_id');
    }
    public function investigation(){
        return $this->belongsTo(Investigation::class, 'investigation_id');
    }
}
