<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
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
        return view('admin.designation.index', compact('user', 'designations', 'sections', 'otherDes', 'active'));
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
        return redirect()->back()->with('success', 'Designation Added Successfully!');
    }
    public function update(Request $request, Designation $designation){
        // dd($request->all(), $designation);
        $formFields = $request->validate([
            'name' => 'required',
        ]);
        $designation->update($formFields);
        return redirect()->back()->with('success', $designation->name . ' Updated Successfully!');
    }
    public function destroy(Request $request){
        // dd($request->all());
        $designation = Designation::findOrFail($request->input('id'));
        
        if ($designation->class == "B") {
            Designation::where('section', $designation->id)->delete();
        }
        $designation->delete();
        return redirect()->back()->with('success', 'Designation Deleted Successfully!');
    }
}
