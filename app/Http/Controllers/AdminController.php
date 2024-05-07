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
        $user = Auth::user();

        return view('admin.home', [
            'active' => 'home',
            'user' => $user,
            
        ]);
    }

    public function adminAccountIndex()
    {
        $users = User::where('type', 'admin')->get();
        $user = Auth::user();
        $active = 'account';
        $type = 'admin';
        return view('admin.account.admin.index', compact('users', 'active', 'user','type'));

    }

    public function userAccountIndex()
    {
        $users = User::where('type', 'user')->get();
        $user = Auth::user();
        $active = 'account';
        $type = 'user';
        return view('admin.account.admin.index', compact('users', 'active', 'user','type'));

    }

    public function accountCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);

        $account = new User();  

        if ($request->input('type') == 'user') {
            $account->privilege = $request['privilege'];
            $account->type = 'user';    
        } else {
            $account->privilege = 'all';
            $account->type = 'admin';
        }

        $account->name = $request['name'];
        $account->email = $request['email'];
        $account->password = Hash::make($request['password']);
        $account->save();

        return redirect()->back()->with('success', 'Account created successfully.');
    }
    
    public function accountUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'privilege' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $userInfoUpdatedData = [
            'name' => $request->input('name'),
            'privilege' => $request->input('privilege'),
            'email' => $request->input('email'),
        ];
        $user = User::findOrFail($request['user_id']);
        $userChange = $this->hasChanges($user, $userInfoUpdatedData);

        if (!$userChange) {
            return redirect()->back()->with('status', 'No changes were made.');
        }

        $user->update($userInfoUpdatedData);

        return redirect()->back()->with('success', 'User updated successfully.');


    }

    public function accountPasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $profile = $request->user();

        $user = User::findOrFail($request->input('password_id'));

        if (Hash::check($request->input('admin_password'), $profile->password)) {
            if ($request->input('password') === $request->input('confirmation')) {
                // Check if the provided password matches the current password
                if (Hash::check($request->input('password'), $user->password)) {
                    return redirect()->back()->with('status', "New password must be different from the current password.");
                }

                // Update the user's password
                $user->password = Hash::make($request->input('password'));
                $user->save();

                return redirect()->back()->with('success', "Password updated successfully.");
            } else {
                return redirect()->back()->with('status', "Password confirmation doesn't match.");
            }
        } else {
            return redirect()->back()->with('status', "Admin password confirmation doesn't match.");

        }

    }

    public function accountDelete(Request $request)
    {
        $request->validate([
            'admin_password' => 'required|min:8',
        ]);

        $profile = $request->user();

        if (Hash::check($request->input('admin_password'), $profile->password)) {
            
            $user = User::where('id', $request->input('account_id'))->first();
            $user->delete();

            return redirect()->back()->with('success', 'Account deleted successfully');

        } else {
            return redirect()->back()->with('status', "Admin password confirmation doesn't match.");

        }
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function hasChanges($info, $updatedData)
    {

        foreach ($updatedData as $key => $value) {

            if ($info->{$key} != $value) {

                return $value;
            }
        }

        return false;

    }
    // public function viewOccupancy(){
    //     $user = Auth::user();
    //     return view('admin.occupancy.index', [
    //         'active' => 'index',
    //         'user' => $user,
    //     ]);
    // }

}
