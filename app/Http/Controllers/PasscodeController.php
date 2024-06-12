<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Station;
use App\Models\Passcode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class PasscodeController extends Controller
{
    public function passcodeIndex()
    {
        $station = Station::first();
        $user = Auth::user();
        $passcodes = Passcode::where("creators_id", auth()->user()->id)->get();
        $active = 'passcode';
        $users = User::where('type', 'user')->get();
        // dd($users);
        return view('admin.passcode.index', compact('user', 'passcodes', 'active', 'users','station'));
    }
    public function passcodeGenerate(Request $request){
        $validatedData = $request->validate([
            'for' => 'required',
        ]);
        $passcode = new Passcode();
        $passcode->creators_id = auth()->user()->id;
        $passcode->code = Str::upper(Str::random(10));
        $passcode->users_id = $validatedData['for'];
        $passcode->save();
        // dd($passcode);
        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
            'Details' => "Created a Passcode a passcode for " . $passcode->user->name . ".</b>",
            'type' => 'passcode',
            'action' => 'Store',
        ]);
        $log->save();
        return redirect()->back()->with("success", "Passcode Generated successfully");
    }

    // public function storePasscode(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'action' => 'required',
    //         'passcode' => 'required|min:8',
    //     ]);

    //     $passcode = new Passcode();
    //     $passcode->type = $request->input('type');
    //     $passcode->action = $request->input('action');
    //     $passcode->code = $request->input('passcode');
    //     $passcode->save();

    //     $log = new ConfigurationLog();

    //     $log->fill([
    //         'userID' => auth()->user()->id,
    //         'Details' => "Created a Passcode with a type of: <b>" . $passcode->type . " - " . $passcode->action ."</b>",
    //         'type' => 'passcode',
    //         'action' => 'Store',
    //     ]);
    //     $log->save();

    //     return redirect()->back()->with('success', 'Passcode created successfully.');
    // }

    // public function updatePasscode(Request $request, $id)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'action' => 'required',
    //         'passcode' => 'required|min:8',
    //         'new_passcode' => 'required|min:8',
    //     ]);

    //     $updatedData = [
    //         'type' => $request->input('type'),
    //         'action' => $request->input('action'),
    //         'code' => $request->input('new_passcode'),
    //     ];

    //     $passcode = Passcode::find($id);
    //     $passcodeChange = $this->hasChanges($passcode, $updatedData);

    //     $string = "Updated Passcode: <b>" . $passcode->type . " - " . $passcode->action ."</b>";

    //     if ($passcodeChange) {
    //         foreach ($passcodeChange as $index => $change) {
    //             $format = str_replace('_', ' ', $index);
    //             $format = ucwords($format);

    //             $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $passcode[$index] . " -> " . $change . "</li>";
    //         }
    //     }
    //     // dd($string);
    //     $log = new ConfigurationLog();
    //     $log->fill([
    //         'userID' => auth()->user()->id,
    //         'Details' => $string,
    //         'type' => 'passcode',
    //         'action' => 'Update',
    //     ]);

    //     $log->save();

    //     $passcode->update($updatedData);

    //     return redirect()->back()->with('success', 'Passcode Updated successfully.');
    // }

    // public function deletePasscode($id)
    // {
    //     $passcode = Passcode::find($id);
    //     $passcode->delete();

    //     $log = new ConfigurationLog();
    //     $log->fill([
    //         'userID' => auth()->user()->id,
    //             'Details' => "Deleted Passcode: <b>" . $passcode->type . " - " . $passcode->action .  " </b>",
    //             'type' => 'passcode',
    //             'action' => 'Delete',
    //     ]);
    //     $log->save();

    //     return redirect()->back()->with('success', 'Passcode deleted successfully.');
    // }

    private function hasChanges($info, $updatedData)
    {
        $changes = [];

        foreach ($updatedData as $key => $value) {
            if ($info->{$key} != $value) {
                $changes[$key] = $value;
            }
        }

        return $changes;
    }
}
