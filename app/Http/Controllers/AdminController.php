<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.home', [
            'active' => 'home',
        ]);
    }

    public function accountIndex()
    {
        $users = User::where('type', 'user')->get();
        $active = 'account';
        return view('admin.account', compact('users', 'active'));

    }

    public function accountCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'privilege' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $account = new User();
        $account->name = $request['name'];
        $account->type = 'user';
        $account->privilege = $request['privilege'];
        $account->email = $request['email'];
        $account->password = Hash::make($request['password']);
        $account->save();

        return redirect()->route('admin.account')->with('success', 'Account created successfully');
    }

    public function accountUpdate(Request $request){
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
