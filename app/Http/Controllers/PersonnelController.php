<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rank;
use App\Models\Tertiary;
use App\Models\Personnel;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Post_graduate_course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    public function personnelIndex()
    {
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::all();
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $personnelCount = count($personnels);
        $designations = Designation::all();
        return view('admin.personnel.index', compact('active', 'personnels', 'user', 'personnelCount', 'ranks', 'maritals', 'genders', 'designations'));
    }

    public function personnelView($id)
    {
        $user = Auth::user();
        $active = 'personnel';
        $ranks = Rank::all();

        $personnel = Personnel::findOrFail($id);
        $tertiaries = Tertiary::where('personnel_id', $personnel->id)->get();
        $courses = Post_graduate_course::where('personnel_id', $personnel->id)->get();
        $files = explode(',', $personnel->files);
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $files = explode(',', $personnel->files);
        return view('admin.personnel.view', compact('active', 'active', 'user', 'personnel', 'ranks', 'maritals', 'tertiaries', 'courses', 'files', 'genders', 'maritals'));
    }

    public function personnelStore(Request $request)
    {

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
            'date_entered_fire_service' => $request->input('date_entered_fire_service') ?? null,
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

        //Response
        $tertiaries = $request->input('tertiary', []);
        $postGraduateCourses = $request->input('postGraduateCourses', []);

        if ($this->hasValues($tertiaries)) {
            foreach ($tertiaries as $key => $tertiary) {
                $tertiary = new Tertiary();
                $tertiary->personnel_id = $personnel_id;
                $tertiary->name = isset($tertiaries[$key]) ? $tertiaries[$key] : '';
                $tertiary->save();
            }
        }

        if ($this->hasValues($postGraduateCourses)) {
            foreach ($postGraduateCourses as $key => $courses) {
                $course = new Post_graduate_course();
                $course->personnel_id = $personnel_id;
                $course->name = isset($postGraduateCourses[$key]) ? $postGraduateCourses[$key] : '';
                $course->save();
            }
        }

        // Photos
        $file = $request->file('image');
        $personnel = Personnel::findOrFail($personnel_id);

        if ($request->hasFile('image')) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('assets/images/personnel_images/'), $fileName);

            $profile = $fileName;
            $personnel->picture = $profile;
            $personnel->save();
        } else {
            $personnel->picture = 'default.png';
            $personnel->save();
        }

        // Files
        $files = $request->file('files');
        $personnel = Personnel::findOrFail($personnel_id);

        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('assets/images/personnel_files/'), $fileName);
                $files_format[] = $fileName;
            }
            $files = implode(',', $files_format);
            $personnel->files = $files;
            $personnel->save();
        }

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
        $designations = Designation::all();
        return view('admin.personnel.edit', compact('active', 'active', 'user', 'personnel', 'ranks', 'maritals', 'tertiaries', 'courses', 'files', 'genders', 'maritals', 'designations'));
    }

    public function personnelUpdate(Request $request)
    {
        $InfoUpdatedData = [
            'account_number' => $request->input('account_number') ?? '',
            'item_number' => $request->input('item_number') ?? '',
            'ranks_id' => $request->input('rank'),
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
            'date_entered_fire_service' => $request->input('date_entered_fire_service') ?? null,
            'mode_of_entry' => $request->input('mode_of_entry') ?? '',
            'appointment_status' => $request->input('appointment_status') ?? '',
            'unit_code' => $request->input('unit_code') ?? '',
            'unit_assignment' => $request->input('unit_assignment') ?? '',
            'designation' => $request->input('designation') ?? '',
            'admin_operation_remarks' => $request->input('admin_operation_remarks') ?? '',
        ];

        $personnel = Personnel::findOrFail($request['personnel_id']);
        $personnelChange = $this->hasChanges($personnel, $InfoUpdatedData);
        $status = false;

        if ($personnelChange) {
            $status = true;
            $personnel->update($InfoUpdatedData);
        }


        // Photo
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();

            if ($personnel->picture != $fileName) {
                $file->move(public_path('assets/images/personnel_images/'), $fileName);
                $profile = $fileName;
                $personnel->picture = $profile;
                $personnel->save();
                $status = true;
            }
        }

        $existPersonnel = Personnel::find($request['operation_id']);
        $default_files = $request->input('default_files', []);
        $personnelFiles = explode(',', $existPersonnel->files);
        $requestIndexes = array_keys($default_files);
        $existIndex = array_keys($personnelFiles);
        $change = false;
        $publicPath = public_path() . '/assets/images/personnel_files/';

        foreach ($personnelFiles as $index => $file) {
            if (!in_array($index, $requestIndexes)) {
                File::delete($publicPath . $personnelFiles[$index]);
                unset($personnelFiles[$index]);
                $status = true;
                $change = true;
            }
        }

        if ($change) {
            $files = implode(',', $personnelFiles);
            $existPersonnel->files = $files;
            $existPersonnel->save();
        }

        $files = $request->file('files');

        if ($request->hasFile('files')) {
            foreach ($files as $file) {

                $fileName = $file->getClientOriginalName();

                if (!in_array($fileName, $personnelFiles)) {
                    $file->move(public_path('personnel_files'), $fileName);
                    array_push($personnelFiles, $fileName);
                    $status = true;
                }
            }

            $files = implode(',', $personnelFiles);
            $existPersonnel->files = $files;
            $existPersonnel->save();
        }

        if ($status) {
            return redirect()->back()->with('success', "Personnel Information Updated successfully.");
        } else {
            return redirect()->back()->with('status', "Nothing's change.");
        }

    }

    public function personnelDelete($id, Request $request)
    {

        $request->validate([
            'password' => 'required',
        ]);

        $personnel = Personnel::find($id);
        $user = Auth::user();
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::all();
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $personnelCount = count($personnels);


        if (Hash::check($request->input('password'), $user->password)) {
            $personnel->delete();
            return redirect()->route('admin.personnel.index', compact('active', 'personnels', 'user', 'personnelCount', 'ranks', 'maritals', 'genders'))->with('success', 'Personnel deleted successfully.');
        } else {
            return redirect()->back()->with('status', 'Admin password is not correct.');
        }
    }

    private function hasValues($array)
    {
        return !empty($array) && count(array_filter($array, 'strlen')) > 0;
    }

    private function hasChanges($info, $updatedData)
    {

        foreach ($updatedData as $key => $value) {

            if ($info->{$key} != $value) {

                return $key;
            }
        }

        return false;
    }
}
