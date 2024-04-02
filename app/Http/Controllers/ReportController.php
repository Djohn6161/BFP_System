<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function investigationIndex(){
        return view('reports.investigation',[
            'active' => 'investigation'
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
