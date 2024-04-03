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
        $active = 'operation';
        $reports = Report::where('category', 'Operation')->get();                                   
        $investigation = Report::where('category', 'Investigation')->get();                                   
        return view('reports.operation', compact('active','reports', 'investigation'));
    }
    public function createReport($id, $type){
        dd($id, $type);
    }
}
