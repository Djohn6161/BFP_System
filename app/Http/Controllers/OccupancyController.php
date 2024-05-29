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

        Occupancy_name::create($validatedData);
        return redirect()->back()->with('success', 'Occupancy, created Successfully.');

    }


    public function updateOccupancyName(Request $request, $id)
    {
        $occupancyName = Occupancy_Name::findOrFail($id);
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|unique:occupancy_names'
        ]);

        $configurationLog = new ConfigurationLog();
        $configurationLog->fill([
            "user_id" => $user->id,
            "details" => "Name: " . $occupancyName->name . " -> " . $request->input('name'),
            "type" => "occupancy",
            "action" => "Update"
        ]);

        $configurationLog->save();
        $occupancyName->update($validatedData);

        return redirect()->back()->with('success', 'Occupancy, update Successfully.');

    }
    public function deleteOccupancyName($id)
    {
        $occupancyName = Occupancy_Name::findOrFail($id);
        $user = Auth::user();

        $configurationLog = new ConfigurationLog();
        $configurationLog->fill([
            "user_id" => $user->id,
            "details" => "Name: " . $occupancyName->name,
            "type" => "occupancy",
            "action" => "Delete"
        ]);
        $configurationLog->save();
        $occupancyName->delete();

        return redirect()->back()->with('success', 'Occupancy, update Successfully.');

    }

}
