<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\Response;
use App\Models\Operation;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        $operations = Afor::all();
        return view('reports.operation', compact('active', 'operations', 'user'));
    }

    public function operationCreate()
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::where('id', '>', 1)->get();
        $trucks = Truck::all();
        return view('reports.operation.operation_form', compact('active', 'user', 'personnels', 'barangays', 'trucks'));
    }

    public function operationCreateSubmit(Request $request)
    {
        $afor = new Afor();
        
        $afor->fill([
            'alarm_received' => $request->input('alarm_received') ?? '',
            'transmitted_by' => $request->input('transmitted_by') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'received_by' => $request->input('received_by') ?? '',
            'barangay_id' => $request->input('barangay') ?? 1,
            'zone' => $request->input('zone') ?? '',
            'location' => $request->input('location') ?? '',
            'td_under_control' => $request->input('td_under_control') ?? '',
            'td_declared_fireout' => $request->input('td_declared_fireout') ?? '',
            'occupancy' => $request->input('occupancy') ?? '',
            'occupancy_specify' => $request->input('occupancy_specify') ?? '',
            'distance_to_fire_incident' => $request->input('distance_to_fire_incident') ?? '',
            'structure_description' => $request->input('structure_description') ?? '',
            'sketch_of_fire_operation' => $request->input('sketch_of_fire_operation') ?? '',
            'details' => $request->input('details') ?? '',
            'problem_encounter' => $request->input('problem_encounter') ?? '',
            'observation_recommendation' => $request->input('observation_recommendation') ?? '',
            'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
            'first_responder' => $request->input('first_responder') ?? '',
        ]);
        
        $afor->save();



        // $savedId = $afor->id;

        // $afor = new Response();

        
    }
}
