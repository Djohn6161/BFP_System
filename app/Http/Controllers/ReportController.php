<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Truck;
use App\Models\Report;
use App\Models\Barangay;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    public function investigationIndex()
    {
        $user = Auth::user();
        $investigation = Report::all()->where('category', 'Investigation');
        $operation = Report::all()->where('category', 'Operation');
        $active = 'investigation';

        return view('reports.investigation', compact('active','investigation','operation','user'));
    }
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        $operations = Afor::all();
        $investigation = Report::where('category', 'Investigation')->get();
        return view('reports.operation', compact('active', 'operations', 'investigation','user'));
    }
    public function createReport($id, $type, $category)
    {
        try {
            $report = Report::findorfail($id);
        } catch (\Exception $ex) {
            $report = null;
            // abort(404);
        }
        if ($category == "Investigation") {
            $active = "Operation";
        } else {
            $active = "Investigation";
        }
        if ($type == "Fire Incident") {
            return view('reports.types.fireIncident', [
                'active' => $active,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type
            ]);
        } elseif ($type == "Vehicular Accident") {
            return view('reports.types.vehicularAccident', [
                'active' => $active,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type
            ]);
        } else {
            return view('reports.types.nonEmergency', [
                'active' => $active,
                'report' => $report,
                'category' => $category,
                'personnels' => Personnel::all(),
                'trucks' => Truck::all(),
                'barangays' => Barangay::all(),
                'type' => $type,
            ]);
        }

    }
    public function storeReport(Request $request, $category)
    {
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
        // dd($validatedData['photos']);
        // if ($request->hasFile('photos')) {
        //     foreach ($variable as $key => $value) {
        //         # code...
        //     }
        //     $validatedData['photos'] = $request->file('photos')->store('report', 'public');
        // }
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
            foreach ($validatedData['photos'] as $photo) {
                $photo->store('report', 'public');
            }
        } catch (\Exception $ex) {
        }
        // dd($validatedData);
        Report::create($validatedData);
        return redirect('reports/' . $category . '/index')->with('message', 'Report Created Successfully');
    }
}
