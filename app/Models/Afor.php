<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afor extends Model
{
    // protected $table = 'afors';
    // protected $fillable = [
    //     'alarm_received',
    //     'transmitted_by',
    //     'caller_address',
    //     'received_by',
    //     'barangay_id',
    //     'zone',
    //     'td_under_control',
    //     'td_declared_fireout',
    //     'occupancy',
    //     'occupancy_specify',
    //     'distance_to_fire_incident',
    //     'structure_description',
    //     'sketch_of_fire_operation',
    //     'details',
    //     'problem_encounter',
    //     'observation_recommendation',
    //     'alarm_status_arrival',
    //     'first_responder',
    // ];

    public function transmittedBy(){
        return $this->belongsTo(Personnel::class, 'transmitted_by');
    }

    public function personRank($id){
        return Rank::where('id', $id)->first();
    }

    use HasFactory;

}
