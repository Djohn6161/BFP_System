<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonnelController extends Controller
{
    public function personnelIndex(){
        $user = Auth::user();
        $active = 'personnel';
        $personnels = Personnel::all();
        $ranks = Rank::all();
        $personnelCount = count($personnels);
        return view('admin.personnel.index', compact('active', 'personnels', 'user','personnelCount','ranks'));    
    }

    public function personnelView($id){
        $user = Auth::user();
        $active = 'personnel';
        $personnel = Personnel::findOrFail($id);
        return view('admin.personnel.view', compact('active', 'active', 'user','personnel')); 
    }

    public function personnelStore(Request $request){
        dd($request->all());
    }
}
