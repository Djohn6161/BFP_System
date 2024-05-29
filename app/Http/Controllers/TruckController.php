<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
{
    public function viewTrucks()
    {
        $user = Auth::user();
        $trucks = Truck::all();
        $active = 'truck';
        return view('admin.trucks.index', compact('user','active', 'trucks'));
       
    }

    public function createTruck(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'plate_num' => 'required',
            'status' => 'required'
        ]);

        $trucks = Truck::create($validatedData);

        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created a truck with a name of " . $trucks->name,
                'type' => 'truck',
                'action' => 'Store',
        ]);
        $log->save();
        
        return redirect()->back()->with('success', 'Truck, created Successfully.');
    }

    public function updateTruck(Request $request, $id)
    {
        $trucks = Truck::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'plate_num' => 'required|unique:trucks,plate_num,'.$id,
            'status' => 'required'
        ]);
            
        $truckChanges = $this->hasChanges($trucks, $validatedData);

        $string = "Updated Truck " . $trucks->name;

        if ($truckChanges) {
            foreach ($truckChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $trucks[$index] . " -> " . $change . "</li>";
            }
        }

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'truck',
                'action' => 'Update',
        ]);
        $log->save();

        $trucks->update($validatedData);
        return redirect()->back()->with('success', 'Truck, update Successfully.');
    }

    public function deleteTruck($id)
    {
        $trucks = Truck::findOrFail($id);
        $trucks->delete();

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Truck " . $trucks->name,
                'type' => 'truck',
                'action' => 'Delete',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Truck deleted successfully.');
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
