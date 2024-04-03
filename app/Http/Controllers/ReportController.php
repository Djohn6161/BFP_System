<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Truck;
use App\Models\Report;
use App\Models\Personnel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function investigationIndex(){
        $investigation = Report::all()->where('category', 'Investigation');
        $operation = Report::all()->where('category', 'Operation');
        return view('reports.investigation',[
            'active' => 'investigation',
            'investigation' => $investigation,
            'operation' => $operation,

        ]);
    }
    public function operationIndex(){
        $active = 'operation';
        $reports = Report::where('category', 'Operation')->get();                                   
        $investigation = Report::where('category', 'Investigation')->get();                                   
        return view('reports.operation', compact('active','reports', 'investigation'));
    }
    public function createReport($id, $type, $category){
    // dd($id != 0, $type);
        // abort(404);
        // $report = "";
        try{
            $report = Report::findorfail($id);
        }catch(\Exception $ex){
            $report = "";
            // abort(404);
        }
        if($type == "Fire Incident"){
            return view('reports.types.fireIncident',[
                'active' => $category,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type
            ]);
        }elseif($type == "Vehicular Accident"){
            return view('reports.types.vehicularAccident',[
                'active' => $category,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type
            ]);
        }else{
            return view('reports.types.nonEmergency',[
                'active' => $category,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type,
            ]);
        }
        
    }
    public function storeReport(Request $request, $category){
        $request->merge(["category" => $category]);
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'type' => 'required',
            'trucks_id' => 'required',
            'drivers_id' => 'required',
            'barangays_id' => 'required',
            'team_leaders_id' => 'required',
            'time_of_departure' => 'required',
            'time_of_arrival_to_scene' => 'required',
            'street' => 'nullable',
            'otherLocation' => 'nullable',
            'number_of_victims' => 'nullable',
            'crewName' => 'nullable',
            'name_of_victims' => 'nullable',
            'property_involved' => 'nullable',
            'remarks' => 'nullable',
            'photos' => 'nullable',
            'time_of_arrival_to_station' => 'required',
        ]);
        // $validatedDate->crewName = "don";
        try {
            $validatedData['crewName'] = implode(", ", $validatedData['crewName']);
        } catch (\Exception $ex) {
            
        }
        try {
            $validatedData['name_of_victims'] = implode(", ", $validatedData['name_of_victims']);
        } catch (\Exception $ex) {
        }
        try {
            $validatedData['photos'] = implode(", ", $validatedData['photos']);
        } catch (\Exception $ex) {
        }
        // dd($validatedData);
        Report::create($validatedData);
        return redirect('reports/' . $category . '/index')->with('message', 'Report Created Successfully');
    }
}
