<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonnelController extends Controller
{
    public function personnelIndex(){
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::all();
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $personnelCount = count($personnels);
        return view('admin.personnel.index', compact('active', 'personnels', 'user', 'personnelCount', 'ranks', 'maritals', 'genders'));
    }

    public function personnelView($id){
        $user = Auth::user();
        $active = 'personnel';
        $ranks = Rank::all();
        $personnel = Personnel::findOrFail($id);
        $tertiaries = Tertiary::where('personnel_id', $personnel->id)->get();
        $files = explode(',', $personnel->files);
        return view('admin.personnel.view', compact('active', 'active', 'user', 'personnel', 'ranks', 'maritals', 'tertiaries', 'courses', 'files', 'genders', 'maritals'));
    }

    public function personnelStore(Request $request){
        $personnel = new Personnel();

        $personnel->fill([
            'ranks_id' => $request->input('rank'),
            'account_number' => $request->input('account_number') ?? '',
            'item_number' => $request->input('item_number') ?? '',
            'first_name' => $request->input('first_name') ?? '',
            'middle_name' => $request->input('middle_name') ?? '',
            'last_name' => $request->input('last_name') ?? '',
            'extension' => $request->input('extension') ?? '',
            'contact_number' => $request->input('contact_number') ?? '',
            'date_of_birth' => $request->input('date_of_birth') ?? null,
            'maritam_status' => $request->input('maritam_status') ?? '',
            'gender' => $request->input('gender') ?? '',
            'address' => $request->input('address') ?? '',
            'religion' => $request->input('religion') ?? '',
            'tin' => $request->input('tin') ?? '',
            'gsis' => $request->input('gsis') ?? '',
            'pagibig' => $request->input('pagibig') ?? '',
            'philhealth' => $request->input('philhealth') ?? '',
            'highest_eligibility' => $request->input('highest_eligibility') ?? '',
            'highest_training' => $request->input('highest_training') ?? '',
            'specialized_training' => $request->input('specialized_training') ?? '',
            'date_entered_other_government_service' => $request->input('date_entered_other_government_service') ?? null,
            'date_entered_fire_service' =>  $request->input('date_entered_fire_service') ?? null,
            'mode_of_entry' => $request->input('mode_of_entry') ?? '',
            'last_date_promotion' => $request->input('last_date_promotion') ?? '',
            'appointment_status' => $request->input('appointment_status') ?? '',
            'unit_code' => $request->input('unit_code') ?? '',
            'unit_assignment' => $request->input('unit_assignment') ?? '',
            'designation' => $request->input('designation') ?? '',
            'admin_operation_remarks' => $request->input('admin_operation_remarks') ?? '',
        ]);
        $personnel->save();
        $personnel_id = $personnel->id;

        return redirect()->back()->with('success', "Operation report added successfully.");
    }

    public function personnelUpdateForm($id)
    {
        $user = Auth::user();
        $active = 'personnel';
        $ranks = Rank::all();
        $personnel = Personnel::findOrFail($id);
        $tertiaries = Tertiary::where('personnel_id', $personnel->id)->get();
        $courses = Post_graduate_course::where('personnel_id', $personnel->id)->get();
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $files = explode(',', $personnel->files);
        return view('admin.personnel.edit', compact('active', 'active', 'user', 'personnel', 'ranks', 'maritals', 'tertiaries', 'courses', 'files', 'genders', 'maritals'));
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
