<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.home',[
            'active' => 'home',
        ]);
    }

    public function viewAccount(){
        return view('admin.account.accounts',[
            'active' => 'accounts',
        ]);
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
