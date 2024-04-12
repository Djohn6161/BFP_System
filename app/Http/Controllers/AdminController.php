<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.home',[
            'active' => 'home',
        ]);
    }

    public function accountIndex(){
        $users = User::where('type', 'user')->get();
        $active = 'account';
        return view('admin.account', compact('users','active'));
        
    }

    public function createAccount(Request $request){
        dd($request);
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
