<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function investigationIndex(){

        return view('reports.investigation',[
            'active' => 'investigation',
            'reports' => Report::all()->where('category', 'Investigation'),
        ]);
    }
    public function operationIndex(){
        $operations = Report::where('category', 'Operation')->get();
        $active = 'operation';
        return view('reports.operation', compact('active','operations'));
    }
    public function createReport($id){
        dd($id);
    }
}
