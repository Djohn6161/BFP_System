<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
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

        $barangay = Barangay::create($validatedData);
        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created a barangay with a name of " . $barangay->name,
                'type' => 'barangay',
                'action' => 'Store',
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Barangay, created Successfully.');
    }

    public function updateBarangay(Request $request, $id)
    {
        $barangays = Barangay::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'unit' => 'required'
        ]);

        $InfoUpdatedData = [
            'name' => $request->input('name'),
            'unit' => $request->input('unit'),
        ];

        $barangayChanges = $this->hasChanges($barangays, $validatedData);

        $string = "Updated Barangay " . $barangays->name;

        if ($barangayChanges) {
            foreach ($barangayChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $barangays[$index] . " -> " . $change . "</li>";
            }
        }

        // dd($string);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'barangay',
                'action' => 'Update',
        ]);
        $log->save();

        $barangays->update($validatedData);
        return redirect()->back()->with('success', 'Barangay, update Successfully.');
    }

    public function deleteBarangay($id)
    {
        $barangays = Barangay::findOrFail($id);
        $barangays->delete();
        
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Barangay " . $barangays->name,
                'type' => 'barangay',
                'action' => 'Delete',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Barangay deleted successfully.');
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