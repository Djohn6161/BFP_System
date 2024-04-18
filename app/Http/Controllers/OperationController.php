<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Barangay;
use App\Models\Operation;
use App\Models\Personnel;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        $operations = Afor::all();
        return view('reports.operation', compact('active', 'operations', 'user'));
    }

    public function operationCreate()
    {
        $user = Auth::user();
        $active = 'operation';
        $personnels = Personnel::all();
        $barangays = Barangay::all();
        $trucks = Truck::all();
        return view('reports.operation.operation_form', compact('active', 'user','personnels','barangays','trucks'));
    }

    public function operationCreateSubmit(Request $request)
    {
        dd($request);
    }
}
