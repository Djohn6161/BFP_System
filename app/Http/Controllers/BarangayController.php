<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangayController extends Controller
{
    public function viewBarangay()
    {
        $user = Auth::user();
        $barangays = Barangay::all();
        $active = 'barangay';
        return view('admin.barangay.index', compact('user','active', 'barangays'));
       
    }

    public function createBarangay(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'unit' => 'required'
        ]);

        Barangay::create($validatedData);
        return redirect()->back()->with('success', 'Barangay, created Successfully.');
    }

    public function updateBarangay(Request $request, $id)
    {
        $barangays = Barangay::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'unit' => 'required'
            
        ]);
            

        $barangays->update($validatedData);
        return redirect()->back()->with('success', 'Barangay, update Successfully.');
       
    }

    public function deleteBarangay($id)
    {
        $barangays = Barangay::findOrFail($id);
        $barangays->delete();

        return redirect()->back()->with('success', 'Barangay deleted successfully.');
    }
}
