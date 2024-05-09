<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Afor;
use App\Models\AforLog;
use App\Models\Truck;
use App\Models\Barangay;
use App\Models\Response;
use App\Models\Occupancy;
use App\Models\Personnel;
use App\Models\Alarm_name;
use Illuminate\Http\Request;
use App\Models\Declared_alarm;
use App\Models\Occupancy_name;
use App\Models\Used_equipment;
use App\Models\Afor_casualties;
use App\Models\Afor_duty_personnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class OperationController extends Controller
{
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        $operations = Afor::whereNull('deleted_at')->orderBy('created_at', 'desc')->get();
        $responses = Response::all();
        $personnels = Personnel::all();

        return view('reports.operation.operation', compact('active', 'operations', 'user', 'personnels', 'responses'));
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
        if ($request->has('location')) {
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
        $log = new AforLog();
        $log->fill([
            'afor_id' => $afor_id,
            'user_id' => auth()->user()->id,
            'details' => "Created an AFOR Report about the operation in " . $afor->location,
            'action' => "Store",
        ]);
        $log->save();
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

        return redirect('/reports/operation/index')->with('success', "Operation report added successfully.");
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
            'details' => $request->input('details') ?? '',
            'problem_encounter' => $request->input('problem_encounter') ?? '',
            'observation_recommendation' => $request->input('observation_recommendation') ?? '',
            'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
            'first_responder' => $request->input('first_responder') ?? '',
        ];

        $operation = AFor::findOrFail($request['operation_id']);
        $operationChange = $this->hasChanges($operation, $InfoUpdatedData);
        $status = false;

        if ($operationChange) {
            $status = true;
            $operation->update($InfoUpdatedData);
        }

        $log = new AforLog();
        $log->fill([
            'afor_id' => $operation->id,
            'user_id' => auth()->user()->id,
            'details' => "Updated an AFOR Report about the operation in " . $operation->location,
            'action' => "Update",
        ]);
        $log->save();
        // Response 
        $engine_dispatched = $request->input('engine_dispatched', []);
        $time_dispatched = $request->input('time_dispatched', []);
        $time_arrived_at_scene = $request->input('time_arrived_at_scene', []);
        $response_duration = $request->input('response_duration', []);
        $time_return_to_base = $request->input('time_return_to_base', []);
        $water_tank_refilled = $request->input('water_tank_refilled', []);
        $gas_consumed = $request->input('gas_consumed', []);

        // Retrieve the existing data from the database
        $existingResponses = Response::where('afor_id', $request->operation_id)->get();
        $requestIndexes = array_keys($engine_dispatched);

        // Loop through existing responses
        foreach ($existingResponses as $index => $existingResponse) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $existingResponse->delete();
                $status = true;
            }
        }

        foreach ($engine_dispatched as $index => $newDispatched) {
            // Check if there's an existing record at this index
            $existingResponse = $existingResponses->get($index);

            $new_time_dispatched = $time_dispatched[$index];
            $new_time_arrived_at_scene = $time_arrived_at_scene[$index];
            $new_response_duration = $response_duration[$index];
            $new_time_return_to_base = $time_return_to_base[$index];
            $new_water_tank_refilled = $water_tank_refilled[$index];
            $new_gas_consumed = $gas_consumed[$index];

            // Check if an existing record exists for this index
            if ($existingResponse) {
                // Check if any field has changed
                $changes = [
                    'engine_dispatched' => $newDispatched,
                    'time_dispatched' => $new_time_dispatched,
                    'time_arrived_at_scene' => $new_time_arrived_at_scene,
                    'response_duration' => $new_response_duration,
                    'time_return_to_base' => $new_time_return_to_base,
                    'water_tank_refilled' => $new_water_tank_refilled,
                    'gas_consumed' => $new_gas_consumed,
                ];

                if ($this->hasChanges($existingResponse, $changes)) {
                    // At least one of the fields has been updated
                    $status = true;
                    // You can log or perform other actions here

                    // Update the existing record with the new data
                    $existingResponse->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newResponse = new Response($changes);
                $newResponse->afor_id = $request->operation_id;
                $newResponse->engine_dispatched = $newDispatched;
                $newResponse->time_dispatched = $new_time_dispatched;
                $newResponse->time_arrived_at_scene = $new_time_arrived_at_scene;
                $newResponse->response_duration = $new_response_duration;
                $newResponse->time_return_to_base = $new_time_return_to_base;
                $newResponse->water_tank_refilled = $new_water_tank_refilled;
                $newResponse->gas_consumed = $new_gas_consumed;

                $newResponse->save(); // Save the new record
                $status = true;
            }
        }

        // Declared Alarm 
        $alarm_names = $request->input('alarm_name', []);
        $time = $request->input('alarm_time', []);
        $ground_commander = $request->input('fund_commander', []);

        // Retrieve the existing data from the database
        $existingAlarms = Declared_alarm::where('afor_id', $request->operation_id)->get();
        $requestIndexes = array_keys($alarm_names);

        // Delete existing alarms that are not present in the request
        foreach ($existingAlarms as $index => $existingAlarm) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $existingAlarm->delete();
                $status = true;
            }
        }

        // Iterate through the request data to update or create alarms
        foreach ($alarm_names as $index => $newAlarmName) {
            // Check if there's an existing record at this index
            $existingAlarm = $existingAlarms->get($index);

            $new_alarm_name = $alarm_names[$index];
            $new_time = $time[$index];
            $new_ground_commander = $ground_commander[$index];

            if ($existingAlarm) {

                $changes = [
                    'alarm_name' => $new_alarm_name,
                    'time' => $new_time,
                    'ground_commander' => $new_ground_commander,
                ];

                if ($this->hasChanges($existingAlarm, $changes)) {
                    $existingAlarm->update($changes);
                    $status = true;
                }
            } else {
                // Create a new alarm
                $newAlarm = new Declared_alarm();
                $newAlarm->afor_id = $request->operation_id;
                $newAlarm->alarm_name = $new_alarm_name;
                $newAlarm->time = $new_time;
                $newAlarm->ground_commander = $new_ground_commander;
                $newAlarm->save(); // Save the new record
                $status = true;
            }
        }

        // Occupancy
        $InfoUpdatedData = [
            'occupancy_name' => $request->input('occupancy_name') ?? '',
            'specify' => $request->input('occupancy_specify') ?? '',
            'distance' => $request->input('distance_to_fire_incident') ?? '',
            'description' => $request->input('structure_description') ?? '',
        ];

        $occupancy = Occupancy::where('afor_id', $request->operation_id)->first();
        $occupancyChange = $this->hasChanges($occupancy, $InfoUpdatedData);

        if ($occupancyChange) {
            $occupancy->update($InfoUpdatedData);
            $status = true;
        }

        // Casualties
        $casualties = Afor_casualties::where('afor_id', $request->operation_id)->get();

        foreach ($casualties as $casualty) {
            $casualtyType = $casualty->type;

            if ($casualtyType == 'civilian') {
                $infoUpdatedData = [
                    'injured' => $request->input('civilian_injured', 0),
                    'death' => $request->input('civilian_deaths', 0),
                ];
            } else {
                $infoUpdatedData = [
                    'injured' => $request->input('firefighter_injured', 0),
                    'death' => $request->input('firefighter_deaths', 0),
                ];
            }

            // Check if any field has changed
            $hasChanges = $this->hasChanges($casualty, $infoUpdatedData);

            if ($hasChanges) {
                $casualty->update($infoUpdatedData);
                $status = true;
            }
        }

        // Breathing equipment 
        $numbers = $request->input('no_breathing', []);
        $types = $request->input('breathing', []);

        // Retrieve the existing data from the database
        $existingBreathings = Used_equipment::where('afor_id', $request->operation_id)->where('category', 'breathing apparatus')->get();
        $requestIndexes = array_keys($types);

        foreach ($existingBreathings as $index => $breathing) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $breathing->delete();
                $status = true;
            }
        }

        foreach ($types as $index => $type) {
            // Check if there's an existing record at this index
            $breathing = $existingBreathings->get($index);

            $new_number = $numbers[$index];
            $new_type = $types[$index];

            // Check if an existing record exists for this index
            if ($breathing) {
                // Check if any field has changed
                $changes = [
                    'quantity' => $new_number,
                    'type' => $new_type,
                ];

                if ($this->hasChanges($breathing, $changes)) {
                    $status = true;
                    $breathing->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newbreathing = new Used_equipment();
                $newbreathing->afor_id = $request->operation_id;
                $newbreathing->quantity = $new_number;
                $newbreathing->type = $new_type;
                $newbreathing->category = 'breathing apparatus';
                $newbreathing->save(); // Save the new record
                $status = true;
            }
        }

        // extinguishing agent equipment 
        $numbers = $request->input('quantity_extinguishing', []);
        $types = $request->input('extinguishing', []);

        // Retrieve the existing data from the database
        $existExtinguishing = Used_equipment::where('afor_id', $request->operation_id)->where('category', 'extinguishing agent')->get();
        $requestIndexes = array_keys($types);

        foreach ($existExtinguishing as $index => $extinguishing) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $extinguishing->delete();
                $status = true;
            }
        }

        foreach ($types as $index => $type) {
            // Check if there's an existing record at this index
            $extinguishing = $existExtinguishing->get($index);

            $new_number = $numbers[$index];
            $new_type = $types[$index];

            // Check if an existing record exists for this index
            if ($extinguishing) {
                // Check if any field has changed
                $changes = [
                    'quantity' => $new_number,
                    'type' => $new_type,
                ];

                if ($this->hasChanges($extinguishing, $changes)) {
                    $status = true;
                    $extinguishing->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newExtinguishing = new Used_equipment();
                $newExtinguishing->afor_id = $request->operation_id;
                $newExtinguishing->quantity = $new_number;
                $newExtinguishing->type = $new_type;
                $newExtinguishing->category = 'extinguishing agent';
                $newExtinguishing->save(); // Save the new record
                $status = true;
            }
        }

        // extinguishing agent equipment 
        $length = $request->input('rope_ladder_length', []);
        $types = $request->input('rope_ladder', []);

        // Retrieve the existing data from the database
        $existRopeLadder = Used_equipment::where('afor_id', $request->operation_id)->where('category', 'rope and ladder')->get();
        $requestIndexes = array_keys($types);

        foreach ($existRopeLadder as $index => $ropeLadder) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $ropeLadder->delete();
                $status = true;
            }
        }

        foreach ($types as $index => $type) {
            // Check if there's an existing record at this index
            $ropeLadder = $existRopeLadder->get($index);

            $new_length = $length[$index];
            $new_type = $types[$index];

            // Check if an existing record exists for this index
            if ($ropeLadder) {
                // Check if any field has changed
                $changes = [
                    'length' => $new_length,
                    'type' => $new_type,
                ];

                if ($this->hasChanges($ropeLadder, $changes)) {
                    $status = true;
                    $ropeLadder->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newRopeLadder = new Used_equipment();
                $newRopeLadder->afor_id = $request->operation_id;
                $newRopeLadder->length = $new_length;
                $newRopeLadder->type = $new_type;
                $newRopeLadder->category = 'rope and ladder';
                $newRopeLadder->save(); // Save the new record
                $status = true;
            }
        }

        // extinguishing agent equipment 
        $length = $request->input('hose_feet', []);
        $quantity = $request->input('no_hose', []);
        $types = $request->input('type_hose', []);

        // Retrieve the existing data from the database
        $existHose = Used_equipment::where('afor_id', $request->operation_id)->where('category', 'hose line')->get();
        $requestIndexes = array_keys($types);

        foreach ($existHose as $index => $hose) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $hose->delete();
                $status = true;
            }
        }

        foreach ($types as $index => $type) {
            // Check if there's an existing record at this index
            $hose = $existHose->get($index);

            $new_length = $length[$index];
            $new_quantity = $quantity[$index];
            $new_type = $types[$index];

            // Check if an existing record exists for this index
            if ($hose) {
                // Check if any field has changed
                $changes = [
                    'length' => $new_length,
                    'quantity' => $new_quantity,
                    'type' => $new_type,
                ];

                if ($this->hasChanges($hose, $changes)) {
                    $status = true;
                    $hose->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newHose = new Used_equipment();
                $newHose->afor_id = $request->operation_id;
                $newHose->length = $new_length;
                $newHose->quantity = $new_quantity;
                $newHose->type = $new_type;
                $newHose->category = 'hose line';
                $newHose->save(); // Save the new record
                $status = true;
            }
        }
        // Duty Personnel
        $personnels = $request->input('duty_personnel_id', []);
        $designations = $request->input('duty_designation', []);
        $remarks = $request->input('duty_remarks', []);

        // Retrieve the existing data from the database
        $existDutyPersonnels = Afor_duty_personnel::where('afor_id', $request->operation_id)->get();
        $requestIndexes = array_keys($personnels);

        foreach ($existDutyPersonnels as $index => $personnel) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $personnel->delete();
                $status = true;
            }
        }

        foreach ($personnels as $index => $personnel) {
            // Check if there's an existing record at this index
            $personnel = $existDutyPersonnels->get($index);

            $new_personnel = $personnels[$index];
            $new_desgination = $designations[$index];
            $new_remarks = $remarks[$index];

            // Check if an existing record exists for this index
            if ($personnel) {
                // Check if any field has changed
                $changes = [
                    'personnels_id' => $new_personnel,
                    'designation' => $new_desgination,
                    'remarks' => $new_remarks,
                ];

                if ($this->hasChanges($personnel, $changes)) {
                    $status = true;
                    $personnel->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newPersonnel = new Afor_duty_personnel();
                $newPersonnel->afor_id = $request->operation_id;
                $newPersonnel->personnels_id = $new_personnel;
                $newPersonnel->designation = $new_desgination;
                $newPersonnel->remarks = $new_remarks;
                $newPersonnel->save();
                $status = true;
            }
        }

        $sketch_of_fire_operation = $request->input('sketch_of_fire_operation', []);
        $default_photos = $request->input('default_photos', []);
        $existOperation = Afor::findOrFail($request['operation_id']);
        $sketchArray = explode(',', $existOperation->sketch_of_fire_operation);
        $requestIndexes = array_keys($default_photos);
        $existIndex = array_keys($sketchArray);
        $change = false;
        $publicPath = public_path() . '/assets/images/operation_images/';

        foreach ($sketchArray as $index => $array) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                File::delete($publicPath . $sketchArray[$index]);
                unset($sketchArray[$index]);
                $status = true;
                $change = true;
            }
        }

        if ($change) {
            $sketch = implode(',', $sketchArray);
            $existOperation->sketch_of_fire_operation = $sketch;
            $existOperation->save();
        }

        $files = $request->file('sketch_of_fire_operation');

        if ($request->hasFile('sketch_of_fire_operation')) {
            foreach ($files as $file) {

                $fileName = $file->getClientOriginalName();

                if (!in_array($fileName, $sketchArray)) {
                    $file->move(public_path('/assets/images/operation_images'), $fileName);
                    array_push($sketchArray, $fileName);
                    $status = true;
                }
            }
            $sketch = implode(',', $sketchArray);
            $existOperation->sketch_of_fire_operation = $sketch;
            $existOperation->save();
        }

        return redirect('/reports/operation/index')->with('success', 'Operation updated successfully.');
    }

    public function operationDelete($id, Request $request)
    {
        $operation = Afor::find($id);
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

        $operation->deleted_at = $formattedDateTime;
        $operation->save();

        return redirect()->back()->with('success', 'Data deleted successfully.');
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
