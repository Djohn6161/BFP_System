<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Spot;
use App\Models\Trash;
use App\Models\Ifinal;
use App\Models\Minimal;
use App\Models\Progress;
use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Models\InvestigationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //Operation
    public function trashOperationIndex()
    {
        return view('admin.trash.operation.index', [
            'active' => 'Operation',
            'user' => Auth::user(),
            // 'minimals' => Minimal::all(),
            'investigations' => Afor::where('deleted_at', '!=', null)->latest()->get(),
            'spots' => Spot::all(),
        ]);
    }


    public function trashOperationDelete($id)
    {
        $investigations = Investigation::findorFail($id);

        $investigations->delete();
        return redirect()->back()->with('success', 'Operation Report deleted successfully');
    }
    //Investigation
    public function trashinvestigationIndex()
    {
        return view('admin.trash.investigation.index', [
            'active' => 'Investigation',
            'user' => Auth::user(),
            // 'minimals' => Minimal::all(),
            'investigations' => Investigation::where('deleted_at', '!=', null)->latest()->get(),
            'spots' => Spot::all(),
        ]);
    }

    public function trashInvestigationDelete(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'password' => 'required',
            'id' => 'required'
        ]);

        $profile = $request->user();

        if (Hash::check($validated['password'], $profile->password)) {

            $investigations = Investigation::findorFail($request->input('id'));
            $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $investigations->id,
                'user_id' => auth()->user()->id,
                'details' => "Permanently Deleted an Investigation with a subject of " . $investigations->subject . ", Created on " . $investigations->date,
                'action' => "Delete",
            ]);
            $log->save();
            if ($investigations->minimal != null) {
                # code...
                $minimal = Minimal::findOrFail($investigations->minimal->id);

                if ($minimal->photos !== null) {
                    $photos = explode(", ", $minimal->photos);
                    // dd($photos);
                    foreach ($photos as $photoToDelete) {
                        if (Storage::disk('public')->exists('minimal/' . $photoToDelete)) {
                            // dd("photo is found: " . $photoToDelete);
                            try {
                                Storage::disk('public')->delete('minimal/' . $photoToDelete);
                            } catch (\Throwable $th) {
                                abort(404, "Page not found");
                            }
                        }
                    }
                }
                $minimal->delete();
            } elseif ($investigations->spot != null) {
                $spot = Spot::findOrFail($investigations->spot->id);
                $spot->delete();
            } elseif ($investigations->progress != null) {
                $progress = Progress::findOrFail($investigations->progress->id);
                $progress->delete();
            } elseif ($investigations->final != null) {
                $final = Ifinal::findOrFail($investigations->final->id);
                $final->delete();
            }

            $investigations->delete();
            return redirect()->back()->with('success', 'Investigation Report deleted Permanently');
        }else{
            return redirect()->back()->with('status', 'Password Incorrect!');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
