<?php

namespace App\Http\Controllers;


use App\Models\Alarm_name;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\ValidatedData;

class AlarmController extends Controller
{
    public function alarmIndex()
    {
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

      $alarms = Alarm_name::create($validatedData);

      $log = new ConfigurationLog();

        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Created an Alarm with a name of: <b>" . $alarms->name . "</b>",
                'type' => 'alarm',
                'action' => 'Store',
        ]);
        $log->save();
        
      return redirect()->back()->with('success', 'Alarm created successfully');
    }

    public function alarmUpdate(Request $request, $id)
    {
        $alarm_list = Alarm_name::findorFail($id);

        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $alarmChanges = $this->hasChanges($alarm_list, $validatedData);

        $string = "Updated Alarm: <b>" . $alarm_list->name . "</b>";

        if ($alarmChanges) {
            foreach ($alarmChanges as $index => $change) {
                $format = str_replace('_', ' ', $index);
                $format = ucwords($format);

                $string = $string . "<li>" . "<b>" . $format . "</b>" . ": " . $alarm_list[$index] . " -> " . $change . "</li>";
            }
        }

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => $string,
                'type' => 'alarm',
                'action' => 'Update',
        ]);
        $log->save();

        $alarm_list->update($validatedData);
      
      return redirect()->back()->with('success', 'Alarm updated successfully');
    }

    public function alarmDelete($id)
    {
        $alarm_list = Alarm_name::findorFail($id);

        $alarm_list->delete();

        $log = new ConfigurationLog();
        $log->fill([
            'userID' => auth()->user()->id,
                'Details' => "Deleted Alarm: <b>" . $alarm_list->name . "</b>",
                'type' => 'alarm',
                'action' => 'Delete',
        ]);
        $log->save();

        return redirect()->back()->with('success', 'Alarm deleted successfully');
    }

    private function hasChanges($info, $updatedData) {
      $changes = [];

      foreach ($updatedData as $key => $value) {
          if ($info->{$key} != $value) {
              $changes[$key] = $value;
          }
      }

      return $changes;
  }
}
