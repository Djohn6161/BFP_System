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
        $accounts = User::where('type', 'admin')->get();
        $user = Auth::user();
        $active = 'account';
        $type = 'admin';
        return view('admin.account.index', compact('accounts', 'active', 'user', 'type'));
    }

    public function userAccountIndex()
    {
        $accounts = User::where('type', 'user')->get();
        $user = Auth::user();
        $active = 'account';
        $type = 'user';
        return view('admin.account.index', compact('accounts', 'active', 'user', 'type'));

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
        $type = $request->input('type');
        $status = false;
        $user = User::findOrFail($request['user_id']);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'admin_confirm_password' => 'required|min:8',
        ]);

        if ($type == 'user') {
            $request->validate([
                'privilege' => 'required|string',
            ]);

            $userInfoUpdatedData = [
                'name' => $request->input('name'),
                'privilege' => $request->input('privilege'),
                'email' => $request->input('email'),
            ];
        } else {
            $userInfoUpdatedData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
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
        dd($request->all());
        $request->validate([
            'password' => 'required|min:8',
        ]);


        $profile = $request->user();

        $user = User::find($request->input('password_id'));


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
}
