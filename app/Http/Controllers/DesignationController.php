<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function designationIndex() {
        $user = Auth::user();
        $designations = Designation::all();
        $active = 'designation';
        $sections = Designation::where('class', "B")->get();
        $designations = Designation::where('class', "C")->get();
        $otherDes = Designation::where('class', "A")->get();
        $station = Station::first();
        return view('admin.designation.index', compact('user', 'designations', 'sections', 'otherDes', 'active', 'station'));
    }
    public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'name' => 'required',
            'class' => 'required',
            'section' => 'nullable',
        ]);
        
        
        $designation = Designation::create($formFields);

        if($formFields['class'] == 'B'){
            $designation->section = $designation->id;
            $designation->name = "C, " . $designation->name;
            $designation->save();
        }

        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created a designation with a name of <b>" . $designation->name . "</b>",
                'type' => 'designation',
                'action' => 'Store',
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Designation Added Successfully!');
    }
    public function update(Request $request, Designation $designation){
        // dd($request->all(), $designation);
        $formFields = $request->validate([
            'name' => 'required',
        ]);
        $designationChanges = $this->hasChanges($designation, $formFields);
        $string = "Updated Designation " . $designation->name;

        if ($designationChanges) {
            foreach ($designationChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $designation[$index] . " -> " . $change . "</li>";
            }
        }

        // dd($formFields, $InfoUpdatedData);
        $designation->update($formFields);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'designation',
                'action' => 'Update',
        ]);
        $log->save();
        return redirect()->back()->with('success', $designation->name . ' Updated Successfully!');
    }
    public function destroy(Request $request){
        // dd($request->all());
        $designation = Designation::findOrFail($request->input('id'));
        $status = ": <b>" .  $designation->name . "</b>";
        if ($designation->class == "B") {
            Designation::where('section', $designation->id)->delete();
            $status = "Entire Section: <b> " . $designation->name . "</b>";
        }
        
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Designation ". $status,
                'type' => 'designation',
                'action' => 'Delete',
        ]);
        $log->save();
        $designation->delete();
        return redirect()->back()->with('success', 'Designation Deleted Successfully!');
    }
    private function hasChanges($info, $updatedData) {
        $changes = [];

        foreach ($updatedData as $key => $value) {
            if ($info->{$key} != $value) {
                $changes[$key] = $value;
            }
        }

        return $changes;
    }
}
