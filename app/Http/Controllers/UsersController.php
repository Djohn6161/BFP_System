<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class UsersController extends Controller
{
    public function dashboard(){
        return view('user.home',[
            'active' => 'home',
        ]);
    }

    public function updateProfile(Request $request){
        dd($request->all());
    }
    public function userLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
