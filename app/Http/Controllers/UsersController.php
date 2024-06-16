<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\User;
// use App\Models\Occupancy;
use App\Models\Station;

use App\Models\Occupancy;
use Illuminate\Http\Request;
use App\Models\Occupancy_name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\returnSelf;

class UsersController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $station = Station::first();
        return view('user.home', [
            'active' => 'home',
            'user' => $user,
            'occupancies' => Occupancy_name::all(),
            'afor' => Afor::whereNull('deleted_at')->get(),
            'occup' => Occupancy::all(),
            'station' => $station
        ]);

    }

    public function updateProfile(Request $request)
    {
        // dd($request);
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,{$user->id}",
        ]);

        $status = false;

        $userInfoUpdatedData = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
        ];

        $user = User::find($request['user_id']);
        $userChange = $this->hasChanges($user, $userInfoUpdatedData);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();

            if ($user->picture != $fileName) {
                $file->move(public_path('assets/images/personnel_images/'), $fileName);
                $profile = $fileName;
                $user->picture = $profile;
                $user->save();
                $status = true;
            }
        }

        if ($userChange) {
            $user->update($userInfoUpdatedData);
            $status = true;
        }

        if ($status) {
            return redirect()->back()->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('status', 'No changes were made.');
        }
    }

    public function updatePassword(Request $request)
    {
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
