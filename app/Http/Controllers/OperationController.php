<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Afor;
use App\Models\Truck;
use App\Models\AforLog;
use App\Models\Station;
use App\Models\Barangay;
use App\Models\Passcode;
use App\Models\Response;
use App\Models\Occupancy;
use App\Models\Personnel;
use App\Models\Alarm_name;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Declared_alarm;
use App\Models\Occupancy_name;
use App\Models\Used_equipment;
use App\Models\Afor_casualties;
use App\Models\Afor_duty_personnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;



class OperationController extends Controller
{
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        $operations = Afor::whereNull('deleted_at')->orderBy('created_at', 'desc')->get();
        $responses = Response::all();
        $personnels = Personnel::all();
        $station = Station::first();
        return view('reports.operation.operation', compact('active', 'operations', 'user', 'personnels', 'responses', 'station'));
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
        $designations = Designation::all();
        $station = Station::first();
        $occupancy_types = ['Structural', 'Non-Structural', 'Vehicular'];
        return view('reports.operation.operation_form', compact('active', 'user', 'personnels', 'barangays', 'trucks', 'alarm_list', 'occupancy_names', 'designations', 'station', 'occupancy_types'));
    }

    public function operationStore(Request $request)
    {

        // dd($request->all());
        $format = "OPT2024_";

        $request->validate([
            'alarm_received' => 'required|string|max:255',
            'transmitted_by' => 'required|string|max:255',
            'caller_address' => 'required|string|max:255',
            'received_by' => 'required',
            'blotter_number' => [
                'required',
                'unique:afors,blotter_number',
                'regex:/^' . preg_quote($format, '/') . '[A-Za-z0-9_]*$/'
            ],
        ]);



        $afor = new Afor();
        if ($request->input('barangay_name') != '') {
            $location = 'Location: ' . $request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . ' Ligao City' . ' Landmark: ' . $request->input('location');
        } else {
            $location = 'Location: ' . $request->input('location');
        }

        $afor->fill([
            'alarm_received' => $request->input('alarm_received'),
            'transmitted_by' => $request->input('transmitted_by'),
            'originator' => $request->input('originator'),
            'caller_address' => $request->input('caller_address'),
            'received_by' => $request->input('received_by'),
            'barangay_name' => $request->input('barangay_name') ?? '',
            'zone' => $request->input('zone') ?? '',
            'location' => $request->input('location') ?? '',
            'blotter_number' => $request->input('blotter_number') ?? '',
            'full_location' => $location,
            'td_under_control' => $request->input('td_under_control') ?? null,
            'td_declared_fireout' => $request->input('td_declared_fireout') ?? null,
            'sketch_of_fire_operation' => $request->input('sketch_of_fire_operation') ?? '',
            'details' => $request->input('details') ?? '',
            'problem_encounter' => $request->input('problem_encounter') ?? '',
            'observation_recommendation' => $request->input('observation_recommendation') ?? '',
            'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
            'first_responder' => $request->input('first_responder') ?? '',
            'prepared_by' => $request->input('prepared_by') ?? '',
            'noted_by' => $request->input('noted_by') ?? '',
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
            'type' => $request->input('occupancy_type') ?? '',
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
        $duty_designations = $request->input('duty_designations', []);
        $duty_remarks = $request->input('duty_remarks', []);

        if ($this->hasValues($duty_personnel_ids)) {
            foreach ($duty_personnel_ids as $key => $duty_personnel_id) {
                $personnel = new Afor_duty_personnel();
                $personnel->afor_id = $afor_id;
                $personnel->personnels_id = $duty_personnel_id;
                $personnel->designation = isset($duty_designations[$key]) ? $duty_designations[$key] : '';
                $personnel->remarks = isset($duty_remarks[$key]) ? $duty_remarks[$key] : '';
                $personnel->save();
            }
        }

        // Photos
        $files = $request->file('sketch_of_fire_operation');

        if ($request->hasFile('sketch_of_fire_operation')) {
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('/assets/images/operation_images'), $fileName);
                $sketch_format[] = $fileName;
            }
            $sketch = implode(',', $sketch_format);
            $afor->sketch_of_fire_operation = $sketch;
            $afor->save();
        }

        $log = new AforLog();
        $log->fill([
            'afor_id' => $afor_id,
            'user_id' => auth()->user()->id,
            'details' => "Created an Operation Report with the location of " . $afor->full_location,
            'action' => "Store",
        ]);

        $log->save();

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
        // $designations = Designation::where('section', 4)->get();
        $designations = Designation::all();
        $duty_personnels = Afor_duty_personnel::where('afor_id', $id)->get();
        $occupancy_types = ['Structural', 'Non-Structural', 'Vehicular'];
        $station = Station::first();
        return view(
            'reports.operation.operation_edit_form',
            compact(
                'active',
                'user',
                'personnels',
                'barangays',
                'trucks',
                'operation',
                'responses',
                'alarm_list',
                'declared_alarms',
                'occupancy_names',
                'occupancy',
                'casualties',
                'used_equipments',
                'duty_personnels',
                'photos',
                'designations',
                'duty_personnels',
                'occupancy_types',
                'station',
            )
        );
    }

    public function operationUpdate(Request $request)
    {
        $extension = ".";
        // dd($request->all());

        if ($request->has('barangay_name')) {
            $location = 'Location: ' . $request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . ' Ligao City ' . 'Landmark: ' . $request->input('location');
        } else {
            $location = $request->input('location');
        }

        $InfoUpdatedData = [
            'alarm_received' => $request->input('alarm_received') ?? '',
            'transmitted_by' => $request->input('transmitted_by') ?? '',
            'originator' => $request->input('originator') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'received_by' => $request->input('received_by') ?? '',
            'barangay_name' => $request->input('barangay_name') ?? '',
            'zone' => $request->input('zone') ?? '',
            'location' => $request->input('location') ?? '',
            'full_location' => $location,
            'blotter_number' => $request->input('blotter_number'),
            'td_under_control' => $request->input('td_under_control') ?? null,
            'td_declared_fireout' => $request->input('td_declared_fireout') ?? null,
            'details' => $request->input('details') ?? '',
            'problem_encounter' => $request->input('problem_encounter') ?? '',
            'observation_recommendation' => $request->input('observation_recommendation') ?? '',
            'alarm_status_arrival' => $request->input('alarm_status_arrival') ?? '',
            'first_responder' => $request->input('first_responder') ?? '',
            'prepared_by' => $request->input('prepared_by') ?? '',
            'noted_by' => $request->input('noted_by') ?? '',
        ];

        $operation = Afor::find($request['operation_id']);
        $request->validate([
            'alarm_received' => 'required|string|max:255',
            'transmitted_by' => 'required|string|max:255',
            'caller_address' => 'required|string|max:255',
            'received_by' => 'required',
            'blotter_number' => "required|unique:afors,blotter_number,{$operation->id}",
        ]);
        $operationChange = $this->hasChanges($operation, $InfoUpdatedData);
        $status = false;
        $string = '';

        if ($operationChange) {
            $string = "Operation Info: <br>";

            foreach ($operationChange as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $operation[$index] . " -> " . $change . "</li>";
            }

            $status = true;
            $operation->update($InfoUpdatedData);
        }

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

        foreach ($existingResponses as $index => $existingResponse) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                $string = $string . "Response Info: <br>";
                $string = $string . "<li>" . "<b> Engine Dispatched: </b>" . $existingResponse->engine_dispatched . " -> Deleted</li>";

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

                $responseChange = $this->hasChanges($existingResponse, $changes);

                if ($responseChange) {
                    $status = true;
                    $string = $string . "Engine Dispatched:" . $existingResponse->engine_dispatched . "<br> Update: <br>";

                    foreach ($responseChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);

                        if ($format == "Engine Dispatched") {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $existingResponse->engine_dispatched . " -> " . $change . "</li>";
                        } else {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $existingResponse[$index] . " -> " . $change . "</li>";
                        }
                    }
                    $existingResponse->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newResponse = new Response();
                $newResponse->afor_id = $request->operation_id;
                $newResponse->engine_dispatched = $newDispatched;
                $newResponse->time_dispatched = $new_time_dispatched;
                $newResponse->time_arrived_at_scene = $new_time_arrived_at_scene;
                $newResponse->response_duration = $new_response_duration;
                $newResponse->time_return_to_base = $new_time_return_to_base;
                $newResponse->water_tank_refilled = $new_water_tank_refilled;
                $newResponse->gas_consumed = $new_gas_consumed;


                $string = $string . "New Engine Dispatched: " . $newDispatched . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Engine Dispatached: </b>" . $newDispatched . "</li>";
                $string = $string . "<li>" . "<b> Time Dispatched: </b>" . $new_time_dispatched . "</li>";
                $string = $string . "<li>" . "<b> Time Arrived At Scene: </b>" . $new_time_arrived_at_scene . "</li>";
                $string = $string . "<li>" . "<b> Response Duration: </b>" . $new_response_duration . "</li>";
                $string = $string . "<li>" . "<b> Time Return to Base: </b>" . $new_time_return_to_base . "</li>";
                $string = $string . "<li>" . "<b> Water Tank Refilled: </b>" . $new_water_tank_refilled . "</li>";
                $string = $string . "<li>" . "<b> Gas Consumed: </b>" . $new_gas_consumed . "</li>";

                $newResponse->save();
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
                $string = $string . "Declared Alarm Info: <br>";
                $string = $string . "<li>" . "<b> Alarm Declared: </b>" . $existingAlarm->alarm_name . " -> Deleted</li>";
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

                $existingAlarmChange = $this->hasChanges($existingAlarm, $changes);

                if ($existingAlarmChange) {

                    $string = $string . "Declated Alarm:" . $existingAlarm->alarm_name . " <br> Updated: <br>";

                    foreach ($existingAlarmChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);
                        $personnel = Personnel::where('id', $change)->first();

                        if ($format == "Ground Commander") {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . "" . $existingAlarm->getgroundCommander->rank->slug . " " . $existingAlarm->getgroundCommander->first_name . " " . $existingAlarm->getgroundCommander->last_name . " -> " . $personnel->rank->slug . " " . $personnel->first_name . " " . $personnel->last_name . "</li>";
                        } else {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $existingAlarm[$index] . " -> " . $change . "</li>";
                        }
                    }
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
                $personnel = Personnel::where('id', $new_ground_commander)->first();

                $string = $string . "New Declared Alarm: " . $new_alarm_name . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Alarm Name: </b>" . $new_alarm_name . "</li>";
                $string = $string . "<li>" . "<b> Time: </b>" . $new_time . "</li>";
                $string = $string . "<li>" . "<b> Ground Commander </b>" . ": " . $personnel->rank->slug . " " . $personnel->first_name . " " . $personnel->last_name . "</li>";

                $newAlarm->save(); // Save the new record
                $status = true;
            }
        }

        // Occupancy
        $InfoUpdatedData = [
            'occupancy_name' => $request->input('occupancy_name') ?? '',
            'type' => $request->input('occupancy_type') ?? '',
            'specify' => $request->input('occupancy_specify') ?? '',
            'distance' => $request->input('distance_to_fire_incident') ?? '',
            'description' => $request->input('structure_description') ?? '',
        ];

        $occupancy = Occupancy::where('afor_id', $request->operation_id)->first();
        $occupancyChange = $this->hasChanges($occupancy, $InfoUpdatedData);

        if ($occupancyChange) {

            $string = $string . "Occupancy Name: " . $occupancy->occupancy_name . "<br>Update: <br>";

            foreach ($occupancyChange as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $occupancy[$index] . " -> " . $change . "</li>";
            }

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

                $title = "Civillian Casualties: <br>Update: <br>";
            } else {
                $infoUpdatedData = [
                    'injured' => $request->input('firefighter_injured', 0),
                    'death' => $request->input('firefighter_deaths', 0),
                ];
                $title = "Firefighter Casualties: <br>Update: <br>";
            }

            // Check if any field has changed
            $casualtiesChange = $this->hasChanges($casualty, $infoUpdatedData);

            if ($casualtiesChange) {

                $string = $string . " " . $title;

                foreach ($casualtiesChange as $index => $change) {
                    $format = str_replace('_', ' ', $index);
                    $format = ucwords($format);

                    $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $casualty[$index] . " -> " . $change . "</li>";
                }

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
                $string = $string . "Breathing Apparatus Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $breathing->type . " -> Deleted</li>";
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

                $breathingChange = $this->hasChanges($breathing, $changes);

                if ($breathingChange) {

                    $string = $string . "Breathing Apparatus Equipment:" . $breathing->type . " <br> Updated: <br>";

                    foreach ($breathingChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);

                        $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $breathing[$index] . " -> " . $change . "</li>";
                    }

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

                $string = $string . "New Breathing Apparatus Equipment: " . $newbreathing->type . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $newbreathing->type . "</li>";
                $string = $string . "<li>" . "<b> Quantity: </b>" . $newbreathing->quantity . "</li>";
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
                $string = $string . "Extinguishing Agend Used Equipment Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $extinguishing->type . " -> Deleted</li>";
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

                $extinguishingChange = $this->hasChanges($extinguishing, $changes);

                if ($extinguishingChange) {

                    $string = $string . "Extinguishing Agend Used Equipment: " . $extinguishing->type . " <br> Updated: <br>";

                    foreach ($extinguishingChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);

                        $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $extinguishing[$index] . " -> " . $change . "</li>";
                    }

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

                $string = $string . "New Extinguishing Agend Used Equipment: " . $newExtinguishing->type . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $newExtinguishing->type . "</li>";
                $string = $string . "<li>" . "<b> Quantity: </b>" . $newExtinguishing->quantity . "</li>";
            }
        }


        // Rope and Ladder equipment 
        $length = $request->input('rope_ladder_length', []);
        $types = $request->input('rope_ladder', []);

        // Retrieve the existing data from the database
        $existRopeLadder = Used_equipment::where('afor_id', $request->operation_id)->where('category', 'rope and ladder')->get();
        $requestIndexes = array_keys($types);

        foreach ($existRopeLadder as $index => $ropeLadder) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $string = $string . "Rope and Ladder Used Equipment Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $ropeLadder->type . " -> Deleted</li>";
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

                $ropeLadderChange = $this->hasChanges($ropeLadder, $changes);

                if ($ropeLadderChange) {

                    $string = $string . "Rope and Ladder Used Equipment: " . $ropeLadder->type . " <br> Updated: <br>";

                    foreach ($ropeLadderChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);

                        $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $ropeLadder[$index] . " -> " . $change . "</li>";
                    }
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

                $string = $string . "Rope and Ladder Used Equipment: " . $newRopeLadder->type . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $newRopeLadder->type . "</li>";
                $string = $string . "<li>" . "<b> Length: </b>" . $newRopeLadder->length . "</li>";
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
                $string = $string . "Hose Line Used Equipment Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $hose->type . " -> Deleted</li>";
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

                $hoseChange = $this->hasChanges($hose, $changes);

                if ($hoseChange) {

                    $string = $string . "Hose Line Used Equipment: " . $hose->type . " <br> Updated: <br>";

                    foreach ($hoseChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);

                        $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $hose[$index] . " -> " . $change . "</li>";
                    }
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

                $string = $string . "New Hose Line Used Used Equipment: " . $newHose->type . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Type: </b>" . $newHose->type . "</li>";
                $string = $string . "<li>" . "<b> Quantity: </b>" . $newHose->quantity . "</li>";
                $string = $string . "<li>" . "<b> Length: </b>" . $newHose->length . "</li>";
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
                $personnelName = Personnel::where('id', $personnel->personnels_id)->first();
                $string = $string . "Duty Personnel Info: <br>" . $personnelName->rank->slug . " " . $personnelName->first_name . " " . $personnelName->last_name;
                $string = $string . "<li> <b> Personnel: </b>" . $personnelName->rank->slug . " " . $personnelName->first_name . " " . $personnelName->last_name . " -> Deleted</li>";
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
                $dutyPersonnelChange = $this->hasChanges($personnel, $changes);

                if ($dutyPersonnelChange) {

                    $personnelName = Personnel::where('id', $personnel->personnels_id)->first();
                    $string = $string . "Duty Personnel: " . $personnelName->rank->slug . " " . $personnelName->first_name . " " . $personnelName->last_name . " <br> Updated: <br>";
                    foreach ($dutyPersonnelChange as $index => $change) {
                        $format = str_replace('_', ' ', $index);
                        $format = ucwords($format);
                        $personnelData = Personnel::where('id', $change)->first();


                        if ($format == "Personnels Id") {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . "" . $personnelName->rank->slug . " " . $personnelName->first_name . " " . $personnelName->last_name . " -> " . $personnelData->rank->slug . " " . $personnelData->first_name . " " . $personnelData->last_name . "</li>";
                        } else {
                            $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $existingAlarm[$index] . " -> " . $change . "</li>";
                        }
                    }
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
                $personnelData = Personnel::where('id', $newPersonnel->personnels_id)->first();

                $string = $string . "New Duty Personnel: " . $personnelData->rank->slug . " " . $personnelData->first_name . " " . $personnelData->last_name . "<br> Info: <br>";
                $string = $string . "<li>" . "<b> Personnel: </b>" . $personnelData->rank->slug . " " . $personnelData->first_name . " " . $personnelData->last_name . "</li>";
                $string = $string . "<li>" . "<b> Designation: </b>" . $newPersonnel->designation . "</li>";
                $string = $string . "<li>" . "<b> Remarks: </b>" . $newPersonnel->remarks . "</li>";
            }
        }

        $sketch_of_fire_operation = $request->input('sketch_of_fire_operation', []);
        $default_photos = $request->input('default_photos', []);
        $existOperation = Afor::find($request->operation_id);
        $sketchArray = explode(',', $existOperation->sketch_of_fire_operation);
        $requestIndexes = array_keys($default_photos);
        $existIndex = array_keys($sketchArray);
        $change = false;
        $publicPath = public_path() . '/assets/images/operation_images/';

        foreach ($sketchArray as $index => $array) {
            if ($array != '') {
                if (!in_array($index, $requestIndexes)) {
                    // Delete the existing response
                    $string = $string . "Sketch of Fire Operation Image: <br>";
                    $string = $string . "<li>" . "<b> Image File Name: </b>" . $sketchArray[$index] . " -> Deleted</li>";
                    File::delete($publicPath . $sketchArray[$index]);
                    unset($sketchArray[$index]);
                    $status = true;
                    $change = true;
                }
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

                    $string = $string . "New Sketch of Fire Operation Image: " . $fileName;
                }
            }
            $sketch = implode(',', $sketchArray);
            $existOperation->sketch_of_fire_operation = $sketch;
            $existOperation->save();
        }
        $string = $string . $extension;
        if ($status) {

            $log = new AforLog();
            $log->fill([
                'afor_id' => $operation->id,
                'user_id' => auth()->user()->id,
                'details' => $string,
                'action' => "Update",
            ]);
            $log->save();

            return redirect('/reports/operation/index')->with('success', 'Operation updated successfully.');
        } else {
            return redirect('/reports/operation/index')->with('success', "Nothing's change.");
        }
    }

    public function operationDelete($id, Request $request)
    {

        $extension = ".";

        if (auth()->user()->privilege != 'operation_admin_chief') {
            $request->validate([
                'passcode' => 'required|string|max:255',
            ]);
        }

        $passcodeStatus = false;
        $passcodes = Passcode::all();

        foreach ($passcodes as $passcode) {
            if ($request->input('passcode') == $passcode->code) {
                $passcodeStatus = true;
                $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                $passcode->delete();
                break; // Stop checking once a match is found
            }
        }

        if (!$passcodeStatus && auth()->user()->privilege != 'operation_admin_chief') {
            return redirect()->back()->with('status', "Passcode doesn't match.");
        }

        $operation = Afor::find($id);
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

        $operation->deleted_at = $formattedDateTime;
        $operation->save();
        $log = new AforLog();
        $log->fill([
            'afor_id' => $operation->id,
            'user_id' => auth()->user()->id,
            'details' => "Deleted an AFOR Report about the operation in " . $operation->location . $extension,
            'action' => "Delete",
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Operation deleted successfully.');
    }

    public function printOperation(Afor $id)
    {
        $station = Station::first();
        return view('reports.operation.printable', [
            'active' => 'operation',
            'user' => Auth::user(),
            'operation' => $id,
            'alarm_names' => Alarm_name::all(),
            'personnels' => Personnel::all(),
            'station' => $station
        ]);
    }

    private function hasValues($array)
    {
        return !empty($array) && count(array_filter($array, 'strlen')) > 0;
    }

    private function hasChanges($info, $updatedData)
    {
        $changes = [];

        foreach ($updatedData as $key => $value) {
            if ($info->{$key} != $value) {
                $changes[$key] = $value;
            }
        }

        return $changes;
    }
}
