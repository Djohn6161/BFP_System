<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rank;
use App\Models\Tertiary;
use App\Models\Personnel;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use App\Models\Post_graduate_course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Personnel_designation;

class PersonnelController extends Controller
{
    public function personnelIndex()
    {
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::orderBy('slug')->get();
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
        $request->validate([
            'account_number' => 'required|string|max:255',
            'item_number' => 'required|string|max:255',
            'rank' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

        ]);

        $personnel = new Personnel();

        $personnel->fill([
            'ranks_id' => $request->input('rank'),
            'account_number' => $request->input('account_number') ?? '',
            'item_number' => $request->input('item_number') ?? '',
            'first_name' => $request->input('first_name') ?? '',
            'middle_name' => $request->input('middle_name') ?? '',
            'last_name' => $request->input('last_name') ?? '',
            'extension' => $request->input('extension') ?? '',
            'contact_number' => $request->input('contact_number') ?? null,
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
            'last_date_promotion' => $request->input('last_date_promotion') ?? null,
            'appointment_status' => $request->input('appointment_status') ?? '',
            'unit_code' => $request->input('unit_code') ?? '',
            'unit_assignment' => $request->input('unit_assignment') ?? '',
            'admin_operation_remarks' => $request->input('admin_operation_remarks') ?? '',
        ]);
        $personnel->save();
        $personnel_id = $personnel->id;

        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
            'Details' => "Created Personnel: <b>" . $personnel->rank->slug . " " . $personnel->last_name . ", " . $personnel->first_name . " " . $personnel->middle_name . "</b>",
            'type' => 'personnel',
            'action' => 'Store',
        ]);

        $log->save();
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
        // Designation
        $designations = $request->input('designations', []);

        if ($this->hasValues($designations)) {
            foreach ($designations as $key => $designation) {
                $newDesignation = new Personnel_designation();
                $newDesignation->personnel_id = $personnel_id;
                $newDesignation->name = $designation;
                $newDesignation->save();
            }
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

        return redirect()->back()->with('success', "Personnel added successfully.");
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
        $old_designations = Personnel_designation::where('personnel_id', $personnel->id)->get();
        return view('admin.personnel.edit', compact('active', 'active', 'user', 'personnel', 'ranks', 'maritals', 'tertiaries', 'courses', 'files', 'genders', 'maritals', 'designations', 'old_designations'));
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
            'contact_number' => $request->input('contact_number') ?? null,
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
            'admin_operation_remarks' => $request->input('admin_operation_remarks') ?? '',
        ];

        $personnel = Personnel::find($request['personnel_id']);
        $personnelChange = $this->hasChanges($personnel, $InfoUpdatedData);
        $personnelChanges = $this->hasChangesMultip($personnel, $InfoUpdatedData);
        // dd($personnelChanges,$personnel, $InfoUpdatedData);
        $status = false;
        $string = "Updated Personnel: <b>" . $personnel->rank->slug . " " . $personnel->last_name . ", " . $personnel->first_name . " " . $personnel->middle_name . "</b>";
        if ($personnelChanges) {
            foreach ($personnelChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $personnel[$index] . " -> " . $change . "</li>";
            }
        }

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
            if ($file != '') {
                if (!in_array($index, $requestIndexes)) {
                    File::delete($publicPath . $personnelFiles[$index]);
                    unset($personnelFiles[$index]);
                    $status = true;
                    $change = true;
                }
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

        // designations
        $designations = $request->input('designations', []);

        // Retrieve the existing data from the database
        $existDesignations = Personnel_designation::where('personnel_id', $personnel->id)->get();
        $requestIndexes = array_keys($designations);

        foreach ($existDesignations as $index => $designation) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $string = $string . "<li>" . "<b> Designation </b>" . ": " . $designation->name . " <i>  Removed </i> </li>";
                $designation->delete();
                $status = true;
            }
        }

        foreach ($designations as $index => $designation) {
            // Check if there's an existing record at this index
            $personnelDesignation = $existDesignations->get($index);

            $new_designation = $designations[$index];

            // Check if an existing record exists for this index
            if ($personnelDesignation) {
                // Check if any field has changed
                $changes = [
                    'name' => $new_designation,
                ];
                // dd($designation);
                if ($this->hasChanges($personnelDesignation, $changes)) {
                    $status = true;
                    // dd($personnelDesignation);
                    $string = $string . "<li>" . "<b>Designation</b>" . ": " . $personnelDesignation->name . " -> " . $changes['name'] . "</li>";
                    $personnelDesignation->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newDesignation = new Personnel_designation();
                $newDesignation->personnel_id = $personnel->id;
                $newDesignation->name = $new_designation;
                $newDesignation->save(); // Save the new record
                $string = $string . "<li>" . "<b>Designation</b>" . ": " . $newDesignation->name . " <i> Added </i></li>";
                $status = true;
            }
        }

        // Tertiaries
        $tertiaries = $request->input('tertiary', []);

        // Retrieve the existing data from the database
        $existTertiaries = Tertiary::where('personnel_id', $personnel->id)->get();
        $requestIndexes = array_keys($tertiaries);

        foreach ($existTertiaries as $index => $tertiary) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $string = $string . "<li>" . "<b> Tertiary </b>" . ": " . $tertiary->name . " <i>  Removed </i> </li>";
                $tertiary->delete();
                $status = true;
            }
        }

        foreach ($tertiaries as $index => $tertiary) {
            // Check if there's an existing record at this index
            $personnelTertiary = $existTertiaries->get($index);

            $new_tertiary = $tertiaries[$index];

            // Check if an existing record exists for this index
            if ($personnelTertiary) {
                // Check if any field has changed
                $changes = [
                    'name' => $new_tertiary,
                ];
                // dd($designation);
                if ($this->hasChanges($personnelTertiary, $changes)) {
                    $status = true;
                    $string = $string . "<li>" . "<b>Tertiary</b>" . ": " . $personnelTertiary->name . " -> " . $changes['name'] . "</li>";
                    $personnelTertiary->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newTertiary = new Tertiary();
                $newTertiary->personnel_id = $personnel->id;
                $newTertiary->name = $new_tertiary;
                $newTertiary->save(); // Save the new record
                $string = $string . "<li>" . "<b>Tertiary</b>" . ": " . $newTertiary->name . " <i> Added </i></li>";
                $status = true;
            }
        }

        // Courses
        $courses = $request->input('courses', []);

        // Retrieve the existing data from the database
        $existCourses = Post_graduate_course::where('personnel_id', $personnel->id)->get();
        $requestIndexes = array_keys($courses);

        foreach ($existCourses as $index => $course) {
            // Check if the index of the existing response is not present in the request
            if (!in_array($index, $requestIndexes)) {
                // Delete the existing response
                $string = $string . "<li>" . "<b> Course </b>" . ": " . $course->name . " <i>  Removed </i> </li>";
                $course->delete();
                $status = true;
            }
        }

        foreach ($courses as $index => $course) {
            // Check if there's an existing record at this index
            $personnelCourse = $existCourses->get($index);

            $new_course = $courses[$index];

            // Check if an existing record exists for this index
            if ($personnelCourse) {
                // Check if any field has changed
                $changes = [
                    'name' => $new_course,
                ];
                // dd($designation);
                if ($this->hasChanges($personnelCourse, $changes)) {
                    $status = true;
                    $string = $string . "<li>" . "<b>Course</b>" . ": " . $personnelCourse->name . " -> " . $changes['name'] . "</li>";
                    $personnelCourse->update($changes);
                }
            } else {
                // No existing record for this index, create a new one
                $newCourse = new Post_graduate_course();
                $newCourse->personnel_id = $personnel->id;
                $newCourse->name = $new_course;
                $newCourse->save(); // Save the new record
                $string = $string . "<li>" . "<b>Course</b>" . ": " . $newCourse->name . " <i> Added </i></li>";
                $status = true;
            }
        }

        if ($status) {
            $log = new ConfigurationLog();
            $log->fill([
                'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'personnel',
                'action' => 'Update',
            ]);
            $log->save();
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

        $personnel = Personnel::findorFail($id);
        $user = Auth::user();
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::all();
        $maritals = ['single', 'married', 'divorced', 'widowed'];
        $genders = ['male', 'female'];
        $personnelCount = count($personnels);


        if (Hash::check($request->input('password'), $user->password)) {
            $log = new ConfigurationLog();
            $log->fill([
                'userID' => auth()->user()->id,
                'Details' => "Deleted Personnel <b>" . $personnel->rank->slug . " " . $personnel->last_name . ", " . $personnel->first_name . " " . $personnel->middle_name . "</b>",
                'type' => 'personnel',
                'action' => 'Delete',
            ]);
            $log->save();
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
    private function hasChangesMultip($info, $updatedData)
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
