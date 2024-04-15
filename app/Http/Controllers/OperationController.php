<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    public function operationIndex()
    {
        $user = Auth::user();
        $active = 'operation';
        // $operations = Report::where('category', 'Operation')->get();
        $operation = Operation::all();
        // $investigation = Report::where('category', 'Investigation')->get();
        return view('reports.operation', compact('active', 'operations', 'investigation','user'));
    }
}
