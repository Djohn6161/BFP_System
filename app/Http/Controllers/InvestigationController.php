<?php

namespace App\Http\Controllers;

use App\Models\Afors;
use App\Models\Barangay;
use App\Models\Ifinal;
use App\Models\Minimal;
use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Models\Personnel;
use App\Models\Progress;
use App\Models\Spot;
use App\Models\Truck;
use Illuminate\Support\Facades\Auth;

class InvestigationController extends Controller
{
    public function index()
    {
        // dd("Hello World");
        return view('reports.investigation.index', [
            'active' => 'investigation',
            'user' => Auth::user(),
            // 'minimals' => Minimal::all(),
            'investigations' => Investigation::all(),
            'spots' => Spot::all(),
        ]);
    }
    public function investigationMinimalIndex()
    {
        // dd();
        $user = Auth::user();
        $active = 'minimal';
        $minimals = Minimal::all();
        $investigations = Minimal::all();
        $spots = Spot::all();
        return view('reports.investigation.minimal', compact('active', 'investigations', 'user', 'minimals', 'spots'));
    }
    public function createMinimal(){
        return view('reports.investigation.minimal.create', [
            'active' => 'minimal',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'personnels' => Personnel::all(),
            'engines' => Truck::all(),
        
        ]);
    }
    public function storeMinimal(Request $request){
        dd($request->all());
    }

    public function Spot()
    {
        return view('reports.investigation.spot', [
            'active' => 'spot',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Spot::all(),
            'spots' => Spot::all(),
        ]);
    }
    public function createSpot(){
        return view('reports.investigation.spot.create', [
            'active' => 'spot',
            'user' => Auth::user(),
        ]);
    }
    public function Progress()
    {
        return view('reports.investigation.progress', [
            'active' => 'progress',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Progress::all(),
            'spots' => Spot::all(),
        ]);
    }
    public function createProgress(){
        return view('reports.investigation.progress.create', [
            'active' => 'progress',
            'user' => Auth::user(),
        ]);
    }
    public function Final()
    {
        return view('reports.investigation.final', [
            'active' => 'final',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Ifinal::all(),
            'spots' => Spot::all(),
        ]);
    }
    public function createFinal(){
        return view('reports.investigation.final.create', [
            'active' => 'final',
            'user' => Auth::user(),
        ]);
    }
}
