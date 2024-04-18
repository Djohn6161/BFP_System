<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Barangay;
use App\Models\Operation;
use App\Models\Personnel;
use App\Models\Truck;
use Illuminate\Http\Request;
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
        $barangays = Barangay::all();
        $trucks = Truck::all();
        return view('reports.operation.operation_form', compact('active', 'user','personnels','barangays','trucks'));
    }

    public function operationCreateSubmit(Request $request)
    {
        $request->validate([
            'alarm_received' => 'required',
            'transmitted_by' => 'required',
            'caller_address' => 'required',
            'received_by' => 'required',
            'barangay' => 'required',
            'zone' => 'required',
            'otherLocation' => 'required',
        ]);

        $engine_dispatched = $request->input('engine_dispatched', []);
        $time_dispatched = $request->input('time_dispatched', []); 
        $time_arrived_at_scene = $request->input('time_arrived_at_scene', []); 
        $response_duration = $request->input('response_duration', []); 
        $time_return_to_base = $request->input('time_return_to_base', []);
        $water_tank_refilled = $request->input('water_tank_refilled', []); 
        $gas_consumed = $request->input('gas_consumed', []);

        dd($request->all());
    }
}
