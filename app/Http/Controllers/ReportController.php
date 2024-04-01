<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function nonResponseIndex(){
        return view('reports.nonresponse',[
            'active' => 'response'
        ]);
    }
    public function ResponseIndex(){
        return view('reports.response',[
            'active' => 'response'
        ]);
    }
}
