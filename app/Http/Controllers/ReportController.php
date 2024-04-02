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
        return view('reports.operation',[
            'active' => 'operation'
        ]);
    }
    public function createReport($id){
        dd($id);
    }
}
