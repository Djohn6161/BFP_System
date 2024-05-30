<?php

namespace App\Http\Controllers;

use App\Models\Occupancy;

use Illuminate\Http\Request;
use App\Models\Occupancy_name;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\ValidatedData;

class OccupancyController extends Controller
{
    public function viewOccupancyNames()
    {
        $user = Auth::user();
        $occupancy_names = Occupancy_name::all();
        $active = 'occupancy';
        return view('admin.occupancy.index', compact('user', 'active', 'occupancy_names'));

    }

    public function createOccupancyName(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',

        ]);

        $occu = Occupancy_name::create($validatedData);
        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created a occupancy with a name of <b>" . $occu->name . "</b>",
                'type' => 'occupancy',
                'action' => 'Store',
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Occupancy, created Successfully.');

    }


    public function updateOccupancyName(Request $request, $id)
    {
        $occupancyName = Occupancy_Name::findOrFail($id);
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|unique:occupancy_names'
        ]);
            
        $occoChanges = $this->hasChanges($occupancyName, $validatedData);
        $string = "Updated Occupancy " . $occupancyName->name;

        if ($occoChanges) {
            foreach ($occoChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $occupancyName[$index] . " -> " . $change . "</li>";
            }
        }

        // dd($formFields, $InfoUpdatedData);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'occupancy',
                'action' => 'Update',
        ]);
        $log->save();
        $occupancyName->update($validatedData);

        return redirect()->back()->with('success', 'Occupancy, update Successfully.');

    }
    public function deleteOccupancyName($id)
    {
        $occupancyName = Occupancy_Name::findOrFail($id);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Designation <b>". $occupancyName->name . "</b>",
                'type' => 'occupancy',
                'action' => 'Delete',
        ]);
        $log->save();
       $occupancyName->delete();
        // $occupancyName->update($validatedData);
        return redirect()->back()->with('success', 'Occupancy, update Successfully.');

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
