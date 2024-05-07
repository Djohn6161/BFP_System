<?php

namespace App\Http\Controllers;

use App\Models\Occupancy;

use Illuminate\Http\Request;
use App\Models\Occupancy_name;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Auth;

class OccupancyController extends Controller
{
    public function viewOccupancyNames()
    {
        $user = Auth::user();
        $occupancy_names = Occupancy_name::all();
        $active = 'occupancy';
        return view('admin.occupancy.index', compact('user','active', 'occupancy_names'));
       
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

        $validatedData = $request->validate([
            'name' => 'required|unique:occupancy_names' 
            
        ]);
            

        $occupancyName->update($validatedData);
        return redirect()->back()->with('success', 'Occupancy, update Successfully.');
       
    }
    public function deleteOccupancyName($id)
    {
        $occupancyName = Occupancy_Name::findOrFail($id);

       $occupancyName->delete();
        // $occupancyName->update($validatedData);
        return redirect()->back()->with('success', 'Occupancy, update Successfully.');
       
    }

}
