<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Declared_alarm;
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

    public function operationCreateForm()
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::all();
        $trucks = Truck::all();
        return view('reports.operation.operation_form', compact('active', 'user', 'personnels', 'barangays', 'trucks'));
    }

    public function operationStore(Request $request)
    {
        // $afor = new Afor();

        // if ($request->has('barangay_name')) {
        //     $location = 'Location: ' . $request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . 'Ligao City' . 'Landmark / Other location: ' . $request->input('location');
        // } else {
        //     $location = 'Location: ' . $request->input('location');
        // }

        // $afor->fill([
        //     'alarm_received' => $request->input('alarm_received') ?? '',
        //     'transmitted_by' => $request->input('transmitted_by') ?? '',
        //     'caller_address' => $request->input('caller_address') ?? '',
        //     'received_by' => $request->input('received_by') ?? '',
        //     'location' => $location,
        //     'td_under_control' => $request->input('td_under_control') ?? '',
        //     'td_declared_fireout' => $request->input('td_declared_fireout') ?? '',
        //     'occupancy' => $request->input('occupancy') ?? '',
        //     'occupancy_specify' => $request->input('occupancy_specify') ?? '',
        //     'distance_to_fire_incident' => $request->input('distance_to_fire_incident') ?? '',
        //     'structure_description' => $request->input('structure_description') ?? '',
        //     'sketch_of_fire_operation' => $request->input('sketch_of_fire_operation') ?? '',
        //     'details' => $request->input('details') ?? '',
        //     'problem_encounter' => $request->input('problem_encounter') ?? '',
        //     'observation_recommendation' => $request->input('observation_recommendation') ?? '',
        //     'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
        //     'first_responder' => $request->input('first_responder') ?? '',
        // ]);

        // $afor->save();

        // $afor_id = $afor->id;

        // $engine_dispatched = $request->input('engine_dispatched', []);
        // $time_dispatched = $request->input('time_dispatched', []);
        // $time_arrived_at_scene = $request->input('time_arrived_at_scene', []);
        // $response_duration = $request->input('response_duration', []);
        // $time_return_to_base = $request->input('time_return_to_base', []);
        // $water_tank_refilled = $request->input('water_tank_refilled', []);
        // $gas_consumed = $request->input('gas_consumed', []);

        // foreach ($engine_dispatched as $key => $engine_dispatch) {
        //     $response = new Response();
        //     $response->afor_id = $afor_id;
        //     $response->engine_dispatched = $engine_dispatch;
        //     $response->time_dispatched = isset($time_dispatched[$key]) ? $time_dispatched[$key] : '';
        //     $response->time_arrived_at_scene = isset($time_arrived_at_scene[$key]) ? $time_arrived_at_scene[$key] : '';
        //     $response->response_duration = isset($response_duration[$key]) ? $response_duration[$key] : '';
        //     $response->time_return_to_base = isset($time_return_to_base[$key]) ? $time_return_to_base[$key] : '';
        //     $response->water_tank_refilled = isset($water_tank_refilled[$key]) ? $water_tank_refilled[$key] : '';
        //     $response->gas_consumed = isset($gas_consumed[$key]) ? $gas_consumed[$key] : '';
        //     $response->save();
        // }

        // $alarm_names = $request->input('alarm_name', []);
        // $alarm_time = $request->input('alarm_time', []);
        // $fund_commander = $request->input('fund_commander', []);

        // foreach ($alarm_names as $key => $alarm_name) {
        //     $alarm = new Declared_alarm();
        //     $alarm->afor_id = 1;
        //     $alarm->alarm_name = $alarm_name;
        //     $alarm->time =isset($alarm_time[$key]) ? $alarm_time[$key] : '';
        //     $alarm->ground_commander = $fund_commander[$key];
        //     $alarm->save();
        // }

        

        return redirect()->back()->with('success', "Operation report added successfully.");
    }

    public function operationUpdate($id)
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::where('id', '>', 1)->get();
        $trucks = Truck::all();
        $operation = Afor::findOrFail($id);
        return view('reports.operation.operation_edit_form', compact('active', 'user', 'personnels', 'barangays', 'trucks', 'operation'));
    }

    public function operationEditSubmit(Request $request)
    {
        $InfoUpdatedData = [
            'alarm_received' => $request->input('alarm_received'),
            'transmitted_by' => $request->input('transmitted_by'),
            'caller_address' => $request->input('caller_address'),
            'received_by' => $request->input('received_by'),
            'barangay_id' => $request->input('barangay'),
            'zone' => $request->input('zone'),
            'location' => $request->input('location'),
            'td_under_control' => $request->input('td_under_control'),
            'td_declared_fireout' => $request->input('td_declared_fireout'),
            'occupancy' => $request->input('occupancy'),
            'occupancy_specify' => $request->input('occupancy_specify'),
            'distance_to_fire_incident' => $request->input('distance_to_fire_incident'),
            'structure_description' => $request->input('structure_description'),
            'sketch_of_fire_operation' => $request->input('sketch_of_fire_operation'),
            'details' => $request->input('details'),
            'problem_encounter' => $request->input('problem_encounter'),
            'observation_recommendation' => $request->input('observation_recommendation'),
            'alarm_status_arrival' => $request->input('alarm_status_arrival'),
            'first_responder' => $request->input('first_responder'),
        ];

        $operation = AFor::findOrFail($request['operation_id']);
        $operationChange = $this->hasChanges($operation, $InfoUpdatedData);

        if (!$operationChange) {
            return redirect()->back()->with('status', 'No changes were made.');
        }

        $operation->update($InfoUpdatedData);

        return redirect()->back()->with('success', 'Operation updated successfully.');



        // $savedId = $afor->id;

        // $afor = new Response();
    }

    private function hasValues($array)
    {
        return !empty($array) && count(array_filter($array, 'strlen')) > 0;
    }

    private function hasChanges($info, $updatedData)
    {

        foreach ($updatedData as $key => $value) {

            if ($info->{$key} != $value) {

                return $value;
            }
        }

        return false;
    }
}
