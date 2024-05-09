<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Spot;
use Illuminate\Http\Request;
use App\Models\Investigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
        return view('admin.trash.investigation.index', [
            'active' => 'Investigation',
            'user' => Auth::user(),
            'investigations' => Investigation::latest()->get(),
            'spots' => Spot::all(),
        ]);
    }

    public function trashInvestigationDelete($id)
    {
        $investigations = Investigation::findorFail($id);

        $investigations->delete();
        return redirect()->back()->with('success', 'Investigation Report deleted successfully');
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
