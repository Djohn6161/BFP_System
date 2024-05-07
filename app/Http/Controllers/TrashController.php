<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Trash;
use App\Models\Minimal;
use Illuminate\Http\Request;
use App\Models\Investigation;
use Illuminate\Support\Facades\Auth;

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
            'investigations' => Investigation::latest()->get(),
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
    public function update(Request $request )
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
