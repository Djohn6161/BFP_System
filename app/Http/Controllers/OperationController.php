<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Afor_casualties;
use App\Models\Afor_duty_personnel;
use App\Models\Alarm_name;
use App\Models\AlarmName;
use App\Models\Duty_personnel;
use App\Models\Occupancy_name;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\Response;
use App\Models\Occupancy;
use App\Models\Operation;
use App\Models\Personnel;
use App\Models\Used_equipment;
use Illuminate\Http\Request;
use App\Models\Declared_alarm;
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
        $alarm_list = Alarm_name::all();
        $occupancy_names = Occupancy_name::all();
        return view('reports.operation.operation_form', compact('active', 'user', 'personnels', 'barangays', 'trucks', 'alarm_list', 'occupancy_names'));
    }

    public function operationStore(Request $request)
    {
        //Afor
        $afor = new Afor();
        if ($request->has('barangay_name')) {
            $location = 'Location: ' . $request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . 'Ligao City' . 'Landmark / Other location: ' . $request->input('location');
        } else {
            $location = 'Location: ' . $request->input('location');
        }

        $afor->fill([
            'alarm_received' => $request->input('alarm_received') ?? '',
            'transmitted_by' => $request->input('transmitted_by') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'received_by' => $request->input('received_by') ?? '',
            'barangay_name' => $request->input('barangay_name') ?? '',
            'zone' => $request->input('zone') ?? '',
            'location' => $request->input('location') ?? '',
            'full_location' => $location,
            'td_under_control' => $request->input('td_under_control') ?? null,
            'td_declared_fireout' => $request->input('td_declared_fireout') ?? null,
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
        $afor_id = $afor->id;

        //Response
        $engine_dispatched = $request->input('engine_dispatched', []);
        $time_dispatched = $request->input('time_dispatched', []);
        $time_arrived_at_scene = $request->input('time_arrived_at_scene', []);
        $response_duration = $request->input('response_duration', []);
        $time_return_to_base = $request->input('time_return_to_base', []);
        $water_tank_refilled = $request->input('water_tank_refilled', []);
        $gas_consumed = $request->input('gas_consumed', []);

        if ($this->hasValues($time_dispatched)) {
            foreach ($engine_dispatched as $key => $engine_dispatch) {
                $response = new Response();
                $response->afor_id = $afor_id;
                $response->engine_dispatched = $engine_dispatch;
                $response->time_dispatched = isset($time_dispatched[$key]) ? $time_dispatched[$key] : '';
                $response->time_arrived_at_scene = isset($time_arrived_at_scene[$key]) ? $time_arrived_at_scene[$key] : '';
                $response->response_duration = isset($response_duration[$key]) ? $response_duration[$key] : '';
                $response->time_return_to_base = isset($time_return_to_base[$key]) ? $time_return_to_base[$key] : '';
                $response->water_tank_refilled = isset($water_tank_refilled[$key]) ? $water_tank_refilled[$key] : '';
                $response->gas_consumed = isset($gas_consumed[$key]) ? $gas_consumed[$key] : '';
                $response->save();
            }
        }


        // Alarm
        $alarm_names = $request->input('alarm_name', []);
        $alarm_time = $request->input('alarm_time', []);
        $fund_commander = $request->input('fund_commander', []);

        if ($this->hasValues($alarm_names)) {
            foreach ($alarm_names as $key => $alarm_name) {
                $alarm = new Declared_alarm();
                $alarm->afor_id = $afor_id;
                $alarm->alarm_name = $alarm_name;
                $alarm->time = isset($alarm_time[$key]) ? $alarm_time[$key] : '';
                $alarm->ground_commander = $fund_commander[$key];
                $alarm->save();
            }
        }

        // Occupancy
        $occupancy = new Occupancy();
        $occupancy->fill([
            'afor_id' => $afor_id,
            'occupancy_name' => $request->input('occupancy_name') ?? '',
            'specify' => $request->input('occupancy_specify') ?? '',
            'distance' => $request->input('distance_to_fire_incident') ?? '',
            'description' => $request->input('structure_description') ?? '',
        ]);

        $occupancy->save();

        // Casualties
        $civillian_casualties = new Afor_casualties();

        $civillian_casualties->fill([
            'afor_id' => $afor_id,
            'type' => 1,
            'injured' => $request->input('civilian_injured') ?? 0,
            'death' => $request->input('civillian_deaths') ?? 0,
        ]);

        $civillian_casualties->save();

        $firefighter_casualties = new Afor_casualties();

        $firefighter_casualties->fill([
            'afor_id' => $afor_id,
            'type' => 2,
            'injured' => $request->input('firefighter_injured') ?? 0,
            'death' => $request->input('firefighter_deaths') ?? 0,
        ]);

        $firefighter_casualties->save();

        // breathing
        $quantity = $request->input('no_breathing', []);
        $types = $request->input('breathing', []);

        if ($this->hasValues($types)) {
            foreach ($types as $key => $type) {
                $used_equipment = new Used_equipment();
                $used_equipment->afor_id = $afor_id;
                $used_equipment->category = 3;
                $used_equipment->quantity = isset($quantity[$key]) ? $quantity[$key] : 0;
                $used_equipment->type = $type;
                $used_equipment->save();
            }
        }


        // extinguishing
        $quantity = $request->input('quantity_extinguishing', []);
        $types = $request->input('extinguishing', []);

        if ($this->hasValues($types)) {
            foreach ($types as $key => $type) {
                $used_equipment = new Used_equipment();
                $used_equipment->afor_id = $afor_id;
                $used_equipment->category = 1;
                $used_equipment->quantity = isset($quantity[$key]) ? $quantity[$key] : 0;
                $used_equipment->type = $type;
                $used_equipment->save();
            }
        }

        // Rope and Ladder
        $length = $request->input('rope_ladder_length', []);
        $types = $request->input('rope_ladder', []);

        if ($this->hasValues($types)) {
            foreach ($types as $key => $type) {
                $used_equipment = new Used_equipment();
                $used_equipment->afor_id = $afor_id;
                $used_equipment->category = 2;
                $used_equipment->length = isset($length[$key]) ? $length[$key] : 0;
                $used_equipment->type = $type;
                $used_equipment->save();
            }
        }

        // Hose
        $nr = $request->input('no_hose', []);
        $types = $request->input('type_hose', []);
        $length = $request->input('hose_feet', []);

        if ($this->hasValues($types)) {
            foreach ($types as $key => $type) {
                $used_equipment = new Used_equipment();
                $used_equipment->afor_id = $afor_id;
                $used_equipment->category = 4;
                $used_equipment->nr = isset($nr[$key]) ? $nr[$key] : 0;
                $used_equipment->type = $type;
                $used_equipment->length = isset($length[$key]) ? $length[$key] : 0;
                $used_equipment->save();
            }
        }

        // Duty Personnel
        $duty_personnel_ids = $request->input('duty_personnel_id', []);
        $duty_designation = $request->input('duty_designation', []);
        $duty_remarks = $request->input('duty_remarks', []);

        if ($this->hasValues($duty_personnel_ids)) {
            foreach ($duty_personnel_ids as $key => $duty_personnel_id) {
                $personnel = new Afor_duty_personnel();
                $personnel->afor_id = $afor_id;
                $personnel->personnels_id = $duty_personnel_id;
                $personnel->designation = isset($duty_designation[$key]) ? $duty_designation[$key] : '';
                $personnel->remarks = isset($duty_remarks[$key]) ? $duty_remarks[$key] : '';
                $personnel->save();
            }
        }


        // Photos
        $files = $request->file('sketch_of_fire_operation');

        if ($request->hasFile('sketch_of_fire_operation')) {
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('operation_image'), $fileName);
                $sketch_format[] = $fileName;
            }
            $sketch = implode(',', $sketch_format);
            $afor->sketch_of_fire_operation = $sketch;
            $afor->save();
        }

        return redirect()->back()->with('success', "Operation report added successfully.");
    }

    public function operationUpdateForm($id)
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::all();
        $trucks = Truck::all();
        $operation = Afor::findOrFail($id);
        $responses = Response::where('afor_id', $id)->get();
        $declared_alarms = Declared_alarm::where('afor_id', $id)->get();
        $alarm_list = Alarm_name::all();
        $occupancy = Occupancy::where('afor_id', $id)->first();
        $occupancy_names = Occupancy_name::all();
        $casualties = Afor_casualties::where('afor_id', $id)->get();
        $used_equipments = Used_equipment::where('afor_id', $id)->get();
        $duty_personnels = Afor_duty_personnel::where('afor_id', $id)->get();
        $sketch = $operation->sketch_of_fire_operation;
        $photos = explode(',', $sketch);
        return view('reports.operation.operation_edit_form', compact('active', 'user', 'personnels', 'barangays', 'trucks', 'operation', 'responses', 'alarm_list', 'declared_alarms', 'occupancy_names', 'occupancy', 'casualties', 'used_equipments', 'duty_personnels', 'photos'));
    }

    public function operationUpdate(Request $request)
    {

        if ($request->has('barangay_name')) {
            $location = 'Location: ' . $request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . ' Ligao City ' . 'Landmark / Other location: ' . $request->input('location');
        } else {
            $location = $request->input('location');
        }

        $InfoUpdatedData = [
            'alarm_received' => $request->input('alarm_received') ?? '',
            'transmitted_by' => $request->input('transmitted_by') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'received_by' => $request->input('received_by') ?? '',
            'barangay_name' => $request->input('barangay_name') ?? '',
            'zone' => $request->input('zone') ?? '',
            'location' => $request->input('location') ?? '',
            'full_location' => $location,
            'td_under_control' => $request->input('td_under_control') ?? null,
            'td_declared_fireout' => $request->input('td_declared_fireout') ?? null,
            'occupancy' => $request->input('occupancy') ?? '',
            'occupancy_specify' => $request->input('occupancy_specify') ?? '',
            'distance_to_fire_incident' => $request->input('distance_to_fire_incident') ?? '',
            'structure_description' => $request->input('structure_description') ?? '',
            // 'sketch_of_fire_operation' => $request->input('sketch_of_fire_operation') ?? '',
            'details' => $request->input('details') ?? '',
            'problem_encounter' => $request->input('problem_encounter') ?? '',
            'observation_recommendation' => $request->input('observation_recommendation') ?? '',
            'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
            'first_responder' => $request->input('first_responder') ?? '',
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
