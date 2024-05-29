<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    public function viewRank()
    {
        $user = Auth::user();
        $ranks = Rank::all();
        $active = 'rank';
        return view('admin.rank.index', compact('user', 'active', 'ranks'));
    }

    public function storeRank(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:ranks'
        ]);

        $rank = Rank::create($validatedData);
        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created a rank with a name of " . $rank->name,
                'type' => 'rank',
                'action' => 'Store',
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Rank created successfully.');
    }

    public function updateRank(Request $request, $id)
    {
        $rank = Rank::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:ranks,slug,' . $rank->id
        ]);

        $rank->update($validatedData);

        return redirect()->back()->with('success', 'Rank updated successfully.');
    }

    public function deleteRank($id)
    {
        $rank = Rank::findOrFail($id);
        $rank->delete();

        return redirect()->back()->with('success', 'Rank deleted successfully.');
    }
}
