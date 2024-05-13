<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
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

        Truck::create($validatedData);
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
            

        $trucks->update($validatedData);
        return redirect()->back()->with('success', 'Truck, update Successfully.');
       
    }

    public function deleteTruck($id)
    {
        $trucks = Truck::findOrFail($id);
        $trucks->delete();

        return redirect()->back()->with('success', 'Truck deleted successfully.');
    }
}
