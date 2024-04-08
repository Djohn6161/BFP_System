<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Brgy_reports;
use App\Models\Crew;
use App\Models\Truck;
use App\Models\Report;
use App\Models\Personnel;
use App\Models\Victim;
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
            $report = null;
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
                // 'victims' => Victim::all()->where('reports_id',)
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
        // dd($request['name_of_victims']);
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'type' => 'required',
            'trucks_id' => 'required',
            'drivers_id' => 'required',
            'barangays_id' => 'nullable',
            'team_leaders_id' => 'required',
            'time_of_departure' => 'required',
            'time_of_arrival_to_scene' => 'required',
            'street' => 'nullable',
            'otherLocation' => 'nullable',
            'number_of_victims' => 'nullable',
            'personnels_id' => 'nullable',
            'name_of_victims' => 'nullable',
            'property_involved' => 'nullable',
            'remarks' => 'nullable',
            'photos' => 'nullable',
            'time_of_arrival_to_station' => 'required',
        ]);
        try {
            // dd($validatedData['photos'][0]);
            if($request->hasFile('photos')){
                $photoPath = [];
                foreach ($validatedData['photos'] as $photo) {
                    $path = $photo->store('report', 'public');
                    $photoPath[] = $path;
                }
                // dd(implode(", ", $photoPath));
                $validatedData['photos'] = implode(", ", $photoPath);
            }
            

        } catch (\Exception $ex) {
            dd("error: ", $ex); 
        }   
        // dd($validatedData);
        unset($validatedData['number_of_victims']);
        unset($validatedData['personnels_id']);
        unset($validatedData['name_of_victims']);
        unset($validatedData['barangays_id']);
        $report = Report::create($validatedData);
        foreach ($request['personnels_id'] as $personnel) {
            $crew = new Crew();
            $crew->personnel_id = $personnel;
            $crew->report_id = $report->id;
            $crew->save();
        }
        if ($validatedData['barangays_id'] ?? false) {
            $brgyReport = new Brgy_reports();
            $brgyReport->brgy_id = $request['barangays_id'];
            $brgyReport->report_id = $report->id;
            $brgyReport->save();
        }
        
        foreach ($request['name_of_victims'] as $victimName) {
            $victim = new Victim();
            $victim->name = $victimName;
            $victim->report_id = $report->id;
            $victim->save();
            # code...
        }
        return redirect('reports/' . $category . '/index')->with('message', 'Report Created Successfully');
    }
}
