<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\User;
use App\Models\Station;
use App\Models\Occupancy;
use Illuminate\Http\Request;
use App\Models\Occupancy_name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.home', [
            'station' => Station::first(),
            'active' => 'home',
            'user' => $user,
            'occupancies' => Occupancy_name::all(),
            'afor' => Afor::whereNull('deleted_at')->get(), 
            'occup' => Occupancy::all(),
        ]);
    }

    public function adminAccountIndex()
    {
        $user = Auth::user();
        $accounts = User::where('type', 'admin')->where('id', '!=', $user->id)->get();
        $active = 'account';
        $type = 'admin';
        $station = Station::first();
        return view('admin.account.index', compact('accounts', 'active', 'user', 'type', 'station'));
    }

    public function userAccountIndex()
    {
        $user = Auth::user();
        $accounts = User::where('type', 'user')->where('id', '!=', $user->id)->get();
        $active = 'account';
        $type = 'user';
        $station = Station::first();
        return view('admin.account.index', compact('accounts', 'active', 'user', 'type', 'station'));

    }

    public function accountCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|max:255|unique:users,username',
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
        $account->username = $request['username'];
        $account->password = Hash::make($request['password']);
        $account->picture = "default.png";
        $account->save();

        return redirect()->back()->with('success', 'Account created successfully.');
    }

    public function accountUpdate(Request $request)
    {
        $type = $request->input('type');
        $status = false;
        $user = User::findOrFail($request['user_id']);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => "required|max:255|unique:users,username,{$user->id}",
            'admin_confirm_password' => 'required|min:8',
        ]);

        if ($type == 'user') {
            $request->validate([
                'privilege' => 'required|string',
            ]);

            $userInfoUpdatedData = [
                'name' => $request->input('name'),
                'privilege' => $request->input('privilege'),
                'username' => $request->input('username'),
            ];
        } else {
            $userInfoUpdatedData = [
                'name' => $request->input('name'),
                'username' => $request->input('username'),
            ];
        }

        if (Hash::check($request->input('admin_confirm_password'), $user->password)) {
            $userChange = $this->hasChanges($user, $userInfoUpdatedData);
            if ($userChange) {
                $user->update($userInfoUpdatedData);
                $status = true;
            }
        } else {
            return redirect()->back()->with('status', 'Admin Password is incorrect.');
        }

        if ($status) {
            return redirect()->back()->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('status', 'No changes were made.');
        }
    }

    public function accountPasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
            'admin_confirm_password' => 'required|min:8',
        ]);

        $profile = $request->user();

        $user = User::find($request->input('password_id'));

        if (Hash::check($request->input('admin_confirm_password'), $profile->password)) {
            if ($request->input('password') === $request->input('confirm_password')) {
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
            'admin_confirm_password' => 'required|min:8',
        ]);

        $profile = $request->user();

        if (Hash::check($request->input('admin_confirm_password'), $profile->password)) {

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

}
