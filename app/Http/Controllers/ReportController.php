<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function investigationIndex(){
        $investigation = Report::all()->where('category', 'Investigation');
        $operation = Report::all()->where('category', 'Operation');
        return view('reports.investigation',[
            'active' => 'investigation',
            'investigation' => $investigation,
            'operation' => $operation,

        ]);
    }
    public function operationIndex(){
        $reports = Report::where('category', 'Operation')->get();
        $active = 'operation';
        return view('reports.operation', compact('active','reports'));
    }
    public function createReport($id){
        dd($id);
    }
}
