<?php

namespace App\Http\Controllers;

use App\Models\Afors;
use App\Models\Barangay;
use App\Models\Ifinal;
use App\Models\Minimal;
use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Models\Personnel;
use App\Models\Progress;
use App\Models\Spot;
use App\Models\Truck;
use Illuminate\Support\Facades\Auth;

class InvestigationController extends Controller
{
    public function index()
    {
        // dd("Hello World");
        return view('reports.investigation.index', [
            'active' => 'investigation',
            'user' => Auth::user(),
            // 'minimals' => Minimal::all(),
            'investigations' => Investigation::latest()->get(),
            'spots' => Spot::all(),
        ]);
    }
    public function investigationMinimalIndex()
    {
        // dd();
        $user = Auth::user();
        $active = 'minimal';
        $minimals = Minimal::all();
        $investigations = Minimal::latest()->get();
        $spots = Spot::all();
        return view('reports.investigation.minimal', compact('active', 'investigations', 'user', 'minimals', 'spots'));
    }
    public function createMinimal(){
        return view('reports.investigation.minimal.create', [
            'active' => 'minimal',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'personnels' => Personnel::all(),
            'engines' => Truck::all(),
        
        ]);
    }
    public function storeMinimal(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'dt_actual_occurence' => 'required',
            'dt_reported' => 'required',
            'barangay' => 'nullable',
            'zone' => 'nullable',
            'landmark' => 'nullable',
            'involved_property' => 'required',
            'property_data' => 'required',
            'receiver' => 'required',
            'caller_name' => 'required',
            'caller_address' => 'required',
            'caller_number' => 'required',
            'notification_originator' => 'required',
            'first_responding_engine' => 'required',
            'first_responding_leader' => 'required',
            'time_arrival_on_scene' => 'required',
            'alarm_status_time' => 'required',
            'Time_Fire_out' => 'required',
            'property_owner' => 'required',
            'property_occupant' => 'required',
            'details' => 'nullable',
            'findings' => 'nullable',
            'recommendation' => 'nullable',
            'photos' => 'nullable',
        ]);
        $investigation = new Investigation();
        $minimal = new Minimal();

        if ($request->has('barangay')) {
            # code...
            $location = "Brgy " . $request->input('barangay') . ' ' . $request->input('zone') . " " . ($request->input('landmark') ?? '') . ' Ligao City, Albay';
        } else {
            $location = $request->input('landmark');
            # code...
        }
        $investigation->fill([
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' =>  $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save(); 
        // dd($investigation);
        $photos = implode(", ", $validatedData['photos']);
        foreach ($validatedData['photos'] as $photo) {
            $photo->store('minimal', 'public');
        }
        $minimal->fill([
            'investigation_id' => $investigation->id,
            'dt_actual_occurence' => $request->input('dt_actual_occurence') ?? '',
            'dt_reported' => $request->input('dt_reported') ?? '',
            'incident_location' => $location ?? '',
            'involved_property' => $request->input('involved_property') ?? '',
            'property_data' => $request->input('property_data') ?? '',
            'property_occupant' => $request->input('property_occupant') ?? '',
            'receiver' => $request->input('receiver') ?? '',
            'caller_name' => $request->input('caller_name') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'caller_number' => $request->input('caller_number') ?? '',
            'notification_originator' => $request->input('notification_originator') ?? '',
            'first_responding_engine' => $request->input('first_responding_engine') ?? '',
            'first_responding_leader' => $request->input('first_responding_leader') ?? '',
            'time_arrival_on_scene' => $request->input('time_arrival_on_scene') ?? '',
            'alarm_status_time' => $request->input('alarm_status_time') ?? '',
            'Time_Fire_out' => $request->input('Time_Fire_out') ?? '',
            'property_owner' => $request->input('property_owner') ?? '',
            'details' => $request->input('details') ?? '',
            'findings' => $request->input('findings') ?? '',
            'recommendation' => $request->input('recommendation') ?? '',
            'photos' => $photos ?? '',
        ]);
        $minimal->save();
        
        return redirect('/reports/investigation/minimal/index')->with("success", "Report Created Successfully!");
        
    }

    public function Spot()
    {
        return view('reports.investigation.spot', [
            'active' => 'spot',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Spot::latest()->get(),
            'spots' => Spot::all(),
        ]);
    }
    public function createSpot(){
        return view('reports.investigation.spot.create', [
            'active' => 'spot',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),

        ]);
    }
    public function storeSpot(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'date_occurence' => 'required',
            'time_occurence' => 'required',
            'barangay' => 'nullable',
            'zone_street' => 'nullable',
            'landmark' => 'nullable',
            'involved' => 'required',
            'name_of_establishment' => 'required',
            'owner' => 'required',
            'alarm' => 'required',
            'occupant' => 'required',
            'fatality' => 'required',
            'injured' => 'required',
            'estimate_damage' => 'required',
            'time_fire_start' => 'required',
            'time_fire_out' => 'required',
            'details' => 'required',
            'disposition' => 'required',
        ]);
        // dd($validatedData);
        $investigation = new Investigation();
        $spot = new Spot();

        if ($request->has('barangay')) {
            # code...
            $location = ($request->input('landmark') ?? '') . " " . $request->input('zone') . " " . $request->input('barangay') . ', Ligao City, Albay';
        } else {
            $location = $request->input('landmark');
            # code...
        }
        $investigation->fill([
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' =>  $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save(); 
        // dd($investigation);
        $spot->fill([
            'investigation_id' => $investigation->id,
            'date_occurence' => $request->input('date_occurence') ?? '',
            'time_occurence' => $request->input('time_occurence') ?? '',
            'address_occurence' => $location ?? '',
            'involved' => $request->input('involved') ?? '',
            'name_of_establishment' => $request->input('name_of_establishment') ?? '',
            'owner' => $request->input('owner') ?? '',
            'occupant' => $request->input('occupant') ?? '',
            'fatality' => $request->input('fatality') ?? '',
            'injured' => $request->input('injured') ?? '',
            'estimate_damage' => $request->input('estimate_damage') ?? '',
            'time_fire_start' => $request->input('time_fire_start') ?? '',
            'time_fire_out' => $request->input('time_fire_out') ?? '',
            'alarm' => $request->input('alarm') ?? '',
            'details' => $request->input('details') ?? '',
            'disposition' => $request->input('disposition') ?? '',
        ]);
        // dd($spot);
        $spot->save();
        
        return redirect('/reports/investigation/Spot/index')->with("success", "Report Created Successfully!");
    }
    public function Progress()
    {
        return view('reports.investigation.progress', [
            'active' => 'progress',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Progress::latest()->get(),
            'spots' => Spot::all(),
        ]);
    }
    public function createProgress(Spot $spot){
        // dd($spot);
        return view('reports.investigation.progress.create', [
            'active' => 'progress',
            'user' => Auth::user(),
            'spot' => $spot,
        ]);
    }
    public function storeProgress(Request $request, Spot $spot){
        
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'authority' => 'required',
            'matters_investigated' => 'required',
            'facts_of_the_case' => 'required',
            'disposition' => 'required',
        ]);
        $investigation = new Investigation();
        $progress = new Progress();
        $investigation->fill([
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' =>  $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save(); 
        // dd($investigation);
        $progress->fill([
            'investigation_id' => $investigation->id,
            'spot_id' => $spot->id,
            'authority' => $request->input('authority') ?? '',
            'matters_investigated' => $request->input('matters_investigated') ?? '',
            'facts_of_the_case' => $request->input('facts_of_the_case') ?? '',
            'disposition' => $request->input('disposition') ?? '',
        ]);
        $progress->save();
        
        return redirect('/reports/investigation/progress/index')->with("success", "Report Created Successfully!");
        // dd($request->all(), $validatedData);
    }
    public function final()
    {
        
        return view('reports.investigation.final', [
            'active' => 'final',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Ifinal::latest()->get(),
            'spots' => Spot::all(),
        ]);
    }
    public function createFinal(){
        return view('reports.investigation.final.create', [
            'active' => 'final',
            'user' => Auth::user(),
        ]);
    }
}
