<?php

namespace App\Http\Controllers;


use App\Models\Alarm_name;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlarmController extends Controller
{
    public function alarmIndex()
    {
        // dd("Hello Worlds");
        $user = Auth::user();
        $active = 'alarm';
        $alarm_list = Alarm_name::all();
 
        return view('admin.alarms.index', compact('active', 'alarm_list', 'user'));
    }

    public function alarmCreate(Request $request)
    {
      $validatedData = $request->validate([
        'name'=> 'required'
      ]);

      Alarm_name::create($validatedData);
      return redirect()->back()->with('success', 'Alarm created successfully');

    }

    public function alarmUpdate(Request $request, $id)
    {
        $alarm_list = Alarm_name::findorFail($id);
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
      $alarm_list->update($validatedData);
      
      return redirect()->back()->with('success', 'Alarm updated successfully');

    }

    public function alarmDelete($id)
    {
        $alarm_list = Alarm_name::findorFail($id);

        $alarm_list->delete();
        return redirect()->back()->with('success', 'Alarm deleted successfully');
    }
}
