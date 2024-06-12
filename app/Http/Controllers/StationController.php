<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    public function viewStations()
    {
        $user = Auth::user();
        $station = Station::first();
        $active = 'station';
        
        return view('admin.stations.index', compact('user','active', 'station'));
       
    }
    // public function edit($id)
    // {
    //     $station = Station::findOrFail($id);
    //     return view('stations.edit', compact('station'));
    // }

    public function updateStations(Request $request, $id)
    {   
        $request->validate([
            'name' => 'required|string|max:255',
            'acronym' => 'required|string|max:255',
            'caseNumberTemp' => 'required|string|max:255',
            'blotterNumberTemp' => 'required|string|max:255',
        ]);

        $station = Station::findOrFail($id);
        $station->name = $request->name;
        $station->acronym = $request->acronym;
        $station->caseNumberTemp = $request->caseNumberTemp;
        $station->blotterNumberTemp = $request->blotterNumberTemp;
        $station->save();

        return redirect()->route('admin.stations.index')->with('success', 'Station updated successfully');
    }
}
