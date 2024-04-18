<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor extends Model
{
    protected $table = 'afor';

    public function transmittedBy(){
        return $this->belongsTo(Personnel::class, 'transmitted_by');
    }

    public function personRank($id){
        return Rank::where('id', $id)->first();
    }

    use HasFactory;

}
