<?php

namespace App\Http\Controllers;

use App\Models\Passcode;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class PasscodeController extends Controller
{
    public function passcodeIndex()
    {
        $user = Auth::user();
        $passcodes = Passcode::all();
        $active = 'passcode';
        return view('admin.passcode.index', compact('user', 'passcodes', 'active'));
    }

    public function storePasscode(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'action' => 'required',
            'passcode' => 'required|min:8',
        ]);

        $passcode = new Passcode();
        $passcode->type = $request->input('type');
        $passcode->action = $request->input('action');
        $passcode->code = $request->input('passcode');
        $passcode->save();

        $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
            'Details' => "Created a Passcode with a type of: <b>" . $passcode->type . " - " . $passcode->action ."</b>",
            'type' => 'passcode',
            'action' => 'Store',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Passcode created successfully.');
    }

    public function updatePasscode(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'action' => 'required',
            'passcode' => 'required|min:8',
            'new_passcode' => 'required|min:8',
        ]);

        $updatedData = [
            'type' => $request->input('type'),
            'action' => $request->input('action'),
            'code' => $request->input('new_passcode'),
        ];

        $passcode = Passcode::find($id);
        $passcodeChange = $this->hasChanges($passcode, $updatedData);

        $string = "Updated Passcode: <b>" . $passcode->type . " - " . $passcode->action ."</b>";

        if ($passcodeChange) {
            foreach ($passcodeChange as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $passcode[$index] . " -> " . $change . "</li>";
            }
        }
        // dd($string);
        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
            'Details' => $string,
            'type' => 'passcode',
            'action' => 'Update',
        ]);

        $log->save();

        $passcode->update($updatedData);

        return redirect()->back()->with('success', 'Passcode Updated successfully.');
    }

    public function deletePasscode($id)
    {
        $passcode = Passcode::find($id);
        $passcode->delete();

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Passcode: <b>" . $passcode->type . " - " . $passcode->action .  " </b>",
                'type' => 'passcode',
                'action' => 'Delete',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Passcode deleted successfully.');
    }

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
