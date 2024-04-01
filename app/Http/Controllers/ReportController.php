<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function nonResponseIndex(){
        return view('reports.nonresponse',[
            'active' => 'nonresponse'
        ])
    }
}
