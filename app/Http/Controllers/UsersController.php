<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\returnSelf;

class UsersController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('user.home', [
            'active' => 'home',
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $userInfoUpdatedData = [
            'name' => $request->input('name'),
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

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|min:8',
            'confirmation' => 'required|min:8',
        ]);

        $profile = $request->user();

        if (Hash::check($request->input('current_password'), $profile->password)) {
            if ($request->input('password') === $request->input('confirmation')) {
                // Check if the provided password matches the current password
                if (Hash::check($request->input('password'), $profile->password)) {
                    return redirect()->back()->with('status', "New password must be different from the current password.");
                }

                // Update the user's password
                $profile->password = Hash::make($request->input('password'));
                $profile->save();

                return redirect()->back()->with('success', "Password updated successfully.");
            } else {
                return redirect()->back()->with('status', "Password confirmation doesn't match.");
            }
        } else {
            return redirect()->back()->with('status', "Admin password confirmation doesn't match.");

        }
    }
    public function userLogout(Request $request): RedirectResponse
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
