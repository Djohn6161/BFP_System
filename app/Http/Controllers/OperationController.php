<?php

namespace App\Http\Controllers;

use App\Models\Afors;
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
        $operations = Afors::all();
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
        $afor = new Afors();

        if(!$request->has('barangay_name')){
            $location =  'Location: ' . $$request->input('zone') . ' ' . 'Brgy: ' . $request->input('barangay_name') . 'Ligao City' . 'Landmark / Other locaation: ' . $request->input('location') ;
        } else {
            $location =  'Location: ' . $request->input('location') ;
        }

        $afor->fill([
            'alarm_received' => $request->input('alarm_received') ?? '',
            'transmitted_by' => $request->input('transmitted_by') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'received_by' => $request->input('received_by') ?? '',
            'barangay_id' => $request->input('barangay') ?? 1,
            'zone' => $request->input('zone') ?? '',
            'location' => $location,
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

        return redirect()->back()->with('success', "Operation report added successfully.");



        // $savedId = $afor->id;

        // $afor = new Response();


    }

    public function operationUpdate($id)
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::where('id', '>', 1)->get();
        $trucks = Truck::all();
        $operation = Afors::findOrFail($id);
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

        $operation = AFors::findOrFail($request['operation_id']);
        $operationChange = $this->hasChanges($operation, $InfoUpdatedData);

        if (!$operationChange) {
            return redirect()->back()->with('status', 'No changes were made.');
        }

        $operation->update($InfoUpdatedData);

        return redirect()->back()->with('success', 'Operation updated successfully.');



        // $savedId = $afor->id;

        // $afor = new Response();
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
