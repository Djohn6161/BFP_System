<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function designationIndex() {
        $user = Auth::user();
        $designations = Designation::all();
        $active = 'designation';
        return view('admin.designation.index', compact('user', 'designations', 'active'));
    }
}
