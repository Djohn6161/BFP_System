<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Spot;
use App\Models\Trash;
use App\Models\Ifinal;
use App\Models\Minimal;
use App\Models\Station;
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
        $station = Station::first();
        return view('admin.trash.operation.index', [
            'active' => 'Operation',
            'user' => Auth::user(),
            'station' => $station,
            'operations' => Afor::whereNotNull('deleted_at')->get(),
        ]);
    }

    public function trashOperationRestore($id)
    {
        $operation = Afor::find($id);
        $operation->deleted_at = null;
        $operation->save();
        
        return redirect()->back()->with('success', 'Operation report restored successfully');
    }


    public function trashOperationDelete($id, Request $request)
    {
        $profile = $request->user();

        if (Hash::check($request->input('admin_confirm_password'), $profile->password)) {
            $operation = Afor::findorFail($id);
            $publicPath = public_path() . '/assets/images/operation_images/';

            if ($operation->sketch_of_fire_operation != '') {
                $photos = explode(',', $operation->sketch_of_fire_operation);

                foreach ($photos as $photo) {
                    File::delete($publicPath . $photo);
                }

                $operation->delete();
            }
            return redirect()->back()->with('success', 'Operation Report deleted successfully');
        } else {
            return redirect()->back()->with('status', "Admin password confirmation doesn't match.");
        }

    }
    //Investigation
    public function trashinvestigationIndex()
    {
        $station = Station::first();
        return view('admin.trash.investigation.index', [
            'active' => 'Investigation',
            'user' => Auth::user(),
            'station' => $station,
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
    public function trashInvestigationRestore(Investigation $investigation){
        $investigation->deleted_at = null;
        $investigation->save();
        $log = new InvestigationLog();
            $log->fill([
                'investigation_id' => $investigation->id,
                'user_id' => auth()->user()->id,
                'details' => "Restored an Investigation with a subject of " . $investigation->subject . ", Created on " . $investigation->date,
                'action' => "Update",
            ]);
            $log->save();
            return redirect()->back()->with('success', 'Investigation Report Restored Successfully');
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
