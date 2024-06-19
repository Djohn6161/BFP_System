<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;

class RankController extends Controller
{
    public function viewRank()
    {
        $user = Auth::user();
        $ranks = Rank::all()->sortByDesc("created_at");
        $active = 'rank';
        $station = Station::first();
        return view('admin.rank.index', compact('user', 'active', 'ranks', 'station'));
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
                'Details' => "Created a Rank with a name of: <b>" . $rank->name . "</b>",
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

        $rankChanges = $this->hasChanges($rank, $validatedData);

        $string = "Updated Rank: <b>" . $rank->name . "</b>";

        if ($rankChanges) {
            foreach ($rankChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $rank[$index] . " -> " . $change . "</li>";
            }
        }

        // dd($string);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'rank',
                'action' => 'Update',
        ]);
        $log->save();

        $rank->update($validatedData);

        return redirect()->back()->with('success', 'Rank updated successfully.');
    }

    public function deleteRank($id)
    {
        $rank = Rank::findOrFail($id);
        $rank->delete();

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Rank: <b>" . $rank->name . "</b>",
                'type' => 'rank',
                'action' => 'Delete',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Rank deleted successfully.');
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
