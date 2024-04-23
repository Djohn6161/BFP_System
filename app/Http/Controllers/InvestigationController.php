<?php

namespace App\Http\Controllers;

use App\Models\Afors;
use App\Models\Minimal;
use Illuminate\Http\Request;
use App\Models\Investigation;
use Illuminate\Support\Facades\Auth;

class InvestigationController extends Controller
{
    public function index()
    {
        // dd("Hello World");
        return view('reports.investigation', [
            'active' => 'investigation',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Investigation::all(),
        ]);
    }
    public function investigationMinimalIndex()
    {
        dd(Minimal::first()->Investigation);
        $user = Auth::user();
        $active = 'minimal';
        $minimals = Minimal::all();
        $investigations = Investigation::all();
        return view('reports.investigation', compact('active', 'investigations', 'user', 'minimals'));
    }

    public function investigationMinimalCreateForm()
    {
        $user = Auth::user();
        $active = 'investigation';
        // $personnels = Personnel::all();
        // $barangays = Barangay::all();
        // $trucks = Truck::all();
        return view('reports.investigaiton.investigation_form', compact('active', 'user',));
    }

    public function Spot()
    {
        return view('reports.investigation', [
            'active' => 'spot',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Investigation::all(),
        ]);
    }
    public function Progress()
    {
        return view('reports.investigation', [
            'active' => 'progress',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Investigation::all(),
        ]);
    }
    public function Final()
    {
        return view('reports.investigation', [
            'active' => 'final',
            'user' => Auth::user(),
            'minimals' => Minimal::all(),
            'investigations' => Investigation::all(),
        ]);
    }
}
