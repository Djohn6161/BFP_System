<?php

namespace App\Http\Controllers;

use App\Models\Afor;
use App\Models\Spot;
use App\Models\Afors;
use App\Models\Truck;
use App\Models\Ifinal;
use App\Models\Victim;
use App\Models\Minimal;
use App\Models\Station;
use App\Models\Barangay;
use App\Models\Passcode;
use App\Models\Progress;
use App\Models\Response;
use App\Models\Personnel;
use App\Models\Alarm_name;

use Illuminate\Http\Request;
use App\Models\Investigation;
use Illuminate\Support\Carbon;
use App\Models\InvestigationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\b;

class InvestigationController extends Controller
{
    public function index()
    {
        // dd("Hello World");
        $station = Station::first();
        return view('reports.investigation.index', [
            'active' => 'investigation',
            'user' => Auth::user(),
            // 'minimals' => Minimal::all(),
            'investigations' => Investigation::where('deleted_at', null)->latest()->get(),
            'spots' => Spot::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'afors' => Afor::all(),
            'personnels' => Personnel::all(),
            'responses' => Response::all(),
            'station' => $station,
        ]);
    }
    public function investigationMinimalIndex()
    {
        // dd();
        $user = Auth::user();
        $active = 'minimal';
        $minimals = Minimal::whereHas('investigation', function ($query) {
            $query->whereNull('deleted_at');
        })->latest()->get();
        $investigations = Minimal::whereHas('investigation', function ($query) {
            $query->whereNull('deleted_at');
        })->latest()->get();
        $spots = Spot::whereHas('investigation', function ($query) {
            $query->whereNull('deleted_at');
        })->latest()->get();
        $afors = Afor::all();
        $responses = Response::all();
        $personnels = Personnel::all();
        $station = Station::first();
        return view('reports.investigation.minimal', compact('personnels', 'responses', 'active', 'investigations', 'user', 'minimals', 'spots', 'afors', 'station'));
    }
    public function createMinimal(Afor $afor)
    {
        $firstResponse = $afor->responses()->orderBy('time_arrived_at_scene', 'asc')->first() ?? null;
        $alarm = $afor->alarmStatus()->orderBy('time', 'asc')->first() ?? null;
        $station = Station::first();
        // dd($firstResponse, $alarm, $afor);
        // dd($firstResponse->truck->name);
        return view('reports.investigation.minimal.create', [
            'active' => 'minimal',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'personnels' => Personnel::all(),
            'engines' => Truck::all(),
            'alarms' => Alarm_name::all(),
            'afor' => $afor,
            'firstRes' => $firstResponse,
            'firstAlarm' => $alarm,
            'station' => $station,
        ]);
    }


    public function Spot()
    {
        $station = Station::first();
        return view('reports.investigation.spot', [
            'active' => 'spot',
            'user' => Auth::user(),
            'minimals' => Minimal::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'investigations' => Spot::latest()->get(),
            'spots' => Spot::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'afors' => Afor::all(),
            'personnels' => Personnel::all(),
            'responses' => Response::all(),
            'station' => $station,
        ]);
    }
    public function createSpot(Afor $afor)
    {
        $firstResponse = $afor->responses()->orderBy('time_arrived_at_scene', 'asc')->first() ?? null;
        $alarm = $afor->alarmStatus()->orderBy('time', 'asc')->first() ?? null;
        $station = Station::first();
        // dd($afor->casualties, $firstResponse, $alarm);
        return view('reports.investigation.spot.create', [
            'active' => 'spot',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'alarms' => Alarm_name::all(),
            'afor' => $afor,
            'firstRes' => $firstResponse,
            'firstAlarm' => $alarm,
            'station' => $station,
        ]);
    }
    public function Progress()
    {
        $station = Station::first();
        return view('reports.investigation.progress', [
            'active' => 'progress',
            'user' => Auth::user(),
            'minimals' => Minimal::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'investigations' => Progress::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'spots' => Spot::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'afors' => Afor::all(),
            'personnels' => Personnel::all(),
            'responses' => Response::all(),
            'station' => $station,
        ]);
    }
    public function storeSpot(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'afor_id' => 'required',
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'date_occurence' => 'required',
            'time_occurence' => 'required',
            'barangay' => 'nullable',
            'zone_street' => 'nullable',
            'landmark' => 'nullable',
            'involved' => 'required',
            'name_of_establishment' => 'required',
            'owner' => 'required',
            'alarm' => 'required',
            'occupant' => 'required',
            'fatality' => 'required',
            'injured' => 'required',
            'estimate_damage' => 'required',
            'time_fire_start' => 'required',
            'time_fire_out' => 'required',
            'details' => 'required',
            'disposition' => 'required',
            'case_number' => 'required|unique:investigations,case_number',
        ]);
        // dd($validatedData);
        $investigation = new Investigation();
        $spot = new Spot();
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone_street')) {
            $location = $location . ', ' . $request->input('zone_street');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }

        $investigation->fill([
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' => $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save();
        // dd($investigation);
        $spot->fill([
            'afor_id' => $validatedData['afor_id'],
            'investigation_id' => $investigation->id,
            'date_occurence' => $request->input('date_occurence') ?? '',
            'time_occurence' => $request->input('time_occurence') ?? '',
            'barangay' => $request->input('barangay') ?? '',
            'street' => $request->input('zone_street') ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'address_occurence' => $location ?? '',
            'involved' => $request->input('involved') ?? '',
            'name_of_establishment' => $request->input('name_of_establishment') ?? '',
            'owner' => $request->input('owner') ?? '',
            'occupant' => $request->input('occupant') ?? '',
            'fatality' => $request->input('fatality') ?? '',
            'injured' => $request->input('injured') ?? '',
            'estimate_damage' => $request->input('estimate_damage') ?? '',
            'time_fire_start' => $request->input('time_fire_start') ?? '',
            'time_fire_out' => $request->input('time_fire_out') ?? '',
            'alarm' => $request->input('alarm') ?? '',
            'details' => $request->input('details') ?? '',
            'disposition' => $request->input('disposition') ?? '',
        ]);
        // dd($spot);
        $spot->save();
        $log = new InvestigationLog();

        $log->fill([
            'investigation_id' => $spot->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Created a spot investigation with a subject of " . $spot->investigation->subject,
            'action' => "Store",
        ]);
        $log->save();
        return redirect()->back()->with("success", "Investigation Created Successfully!");
    }
    public function createProgress(Spot $spot)
    {
        // dd($spot);
        $station = Station::first();
        return view('reports.investigation.progress.create', [
            'active' => 'progress',
            'user' => Auth::user(),
            'spot' => $spot,
            'station' => $station,
        ]);
    }
    public function storeProgress(Request $request, Spot $spot)
    {

        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'authority' => 'required',
            'matters_investigated' => 'required',
            'facts_of_the_case' => 'required',
            'disposition' => 'required',
            'case_number' => 'required|unique:investigations,case_number',
        ]);
        $investigation = new Investigation();
        $progress = new Progress();
        $investigation->fill([
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' => $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save();
        // dd($investigation);
        $progress->fill([
            'investigation_id' => $investigation->id,
            'spot_id' => $spot->id,
            'authority' => $request->input('authority') ?? '',
            'matters_investigated' => $request->input('matters_investigated') ?? '',
            'facts_of_the_case' => $request->input('facts_of_the_case') ?? '',
            'disposition' => $request->input('disposition') ?? '',
        ]);
        $progress->save();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $progress->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Created a Progress Investigation of " . $spot->investigation->subject . " with a subject of " . $progress->investigation->subject,
            'action' => "Store",
        ]);
        $log->save();
        return redirect()->back()->with("success", "Investigation Created Successfully!");
        // dd($request->all(), $validatedData);
    }
    public function final()
    {
        $station = Station::first();
        return view('reports.investigation.final', [
            'active' => 'final',
            'user' => Auth::user(),
            'minimals' => Minimal::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'investigations' => Ifinal::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'spots' => Spot::whereHas('investigation', function ($query) {
                $query->whereNull('deleted_at');
            })->latest()->get(),
            'afors' => Afor::all(),
            'personnels' => Personnel::all(),
            'responses' => Response::all(),
            'station' => $station,
        ]);
    }
    public function createFinal(Spot $spot)
    {
        $station = Station::first();
        return view('reports.investigation.final.create', [
            'active' => 'final',
            'user' => Auth::user(),
            'spot' => $spot,
            'barangay' => Barangay::all(),
            'station' => $station,
        ]);
    }
    public function storeFinal(Request $request, Spot $spot)
    {
        // dd($request->input('victim'));
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'intelligence_unit' => 'required',
            'barangay' => 'nullable',
            'zone_street' => 'nullable',
            'landmark' => 'nullable',
            'time_alarm' => 'required',
            'date_alarm' => 'required',
            'establishment_burned' => 'required',
            'damage_to_property' => 'required',
            'victim' => 'nullable',
            'origin_of_fire' => 'required',
            'cause_of_fire' => 'required',
            'substantiating_documents' => 'required',
            'facts_of_the_case' => 'required',
            'discussion' => 'required',
            'findings' => 'required',
            'recommendation' => 'required',
            'case_number' => 'required|unique:investigations,case_number',
        ]);
        // dd($validatedData);
        $investigation = new Investigation();
        $final = new Ifinal();
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone_street')) {
            $location = $location . ', ' . $request->input('zone_street');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }

        $td = ($request->input('time_alarm') ?? '') . " " . ($request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '');
        $investigation->fill([
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' => $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save();
        if ($request->input('victim')) {
            foreach ($request->input('victim') as $victi) {
                # code...
                $victim = new Victim();
                $victim->investigation_id = $investigation->id;
                $victim->name = $victi;
                $victim->save();
            }
        }

        // dd($investigation);
        $final->fill([
            'investigation_id' => $investigation->id,
            'spot_id' => $spot->id,
            'intelligence_unit' => $request->input('intelligence_unit') ?? '',
            'barangay' => $request->input('barangay') ?? '',
            'street' => $request->input('zone_street') ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'place_of_fire' => $location ?? '',
            'td_alarm' => $td ?? '',
            'establishment_burned' => $request->input('establishment_burned') ?? '',
            'damage_to_property' => $request->input('damage_to_property') ?? '',
            'origin_of_fire' => $request->input('origin_of_fire') ?? '',
            'cause_of_fire' => $request->input('cause_of_fire') ?? '',
            'substantiating_documents' => $request->input('substantiating_documents') ?? '',
            'facts_of_the_case' => $request->input('facts_of_the_case') ?? '',
            'discussion' => $request->input('discussion') ?? '',
            'findings' => $request->input('findings') ?? '',
            'recommendation' => $request->input('recommendation') ?? '',
        ]);
        // dd($spot);
        $final->save();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $final->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Created a Final Investigation of " . $spot->investigation->subject . " with a subject of " . $final->investigation->subject,
            'action' => "Store",
        ]);
        $log->save();
        return redirect()->back()->with("success", "Investigation Created Successfully!");
    }
    public function editMinimal(Minimal $minimal)
    {
        // dd($minimal);
        if ($minimal->landmark == null || $minimal->landmark == "") {
            $location = $minimal->incident_location;
        } else {
            $location = $minimal->landmark;
        }
        // dd($location);
        if ($minimal->photos != '') {
            $photos = explode(", ", $minimal->photos);
        }
        $station = Station::first();
        // dd($photos);
        return view('reports.investigation.minimal.edit', [
            'active' => 'minimal',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'personnels' => Personnel::all(),
            'engines' => Truck::all(),
            'alarm' => Alarm_name::all(),
            'minimal' => $minimal,
            'location' => $location,
            'photos' => $photos ?? [],
            'station' => $station
        ]);
    }
    public function storeMinimal(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'afor_id' => 'required',
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'dt_actual_occurence' => 'required',
            'dt_reported' => 'required',
            'barangay' => 'nullable',
            'zone' => 'nullable',
            'landmark' => 'nullable',
            'involved_property' => 'required',
            'property_data' => 'required',
            'receiver' => 'required',
            'caller_name' => 'required',
            'caller_address' => 'required',
            'caller_number' => 'required',
            'notification_originator' => 'required',
            'first_responding_engine' => 'required',
            'first_responding_leader' => 'required',
            'time_arrival_on_scene' => 'required',
            'alarm_status_time' => 'required',
            'Time_Fire_out' => 'required',
            'property_owner' => 'required',
            'property_occupant' => 'required',
            'details' => 'nullable',
            'findings' => 'nullable',
            'recommendation' => 'nullable',
            'photos' => 'nullable',
            'case_number' => 'required|unique:investigations,case_number'
        ]);
        $investigation = new Investigation();
        $minimal = new Minimal();
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone')) {
            $location = $location . ', ' . $request->input('zone');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }
        $investigation->fill([
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $request->input('for') ?? '',
            'subject' => $request->input('subject') ?? '',
            'date' => $request->input('date') != null ? date('Y-m-d', strtotime($request->input('date'))) : '',
        ]);
        $investigation->save();
        // dd($investigation);
        if ($validatedData['photos'] ?? false) {

            foreach ($validatedData['photos'] as $photo) {
                $filePath = baseName($photo->store('minimal', 'public'));
                $fileNames[] = $filePath;
                // $fileName = baseName($file)
            }
            $photos = implode(", ", $fileNames);
        }

        $minimal->fill([
            'afor_id' => $validatedData['afor_id'],
            'investigation_id' => $investigation->id,
            'dt_actual_occurence' => $request->input('dt_actual_occurence') ?? '',
            'dt_reported' => $request->input('dt_reported') ?? '',
            'barangay' => $request->input('barangay') ?? '',
            'street' => $request->input('zone') ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'incident_location' => $location ?? '',
            'involved_property' => $request->input('involved_property') ?? '',
            'property_data' => $request->input('property_data') ?? '',
            'property_occupant' => $request->input('property_occupant') ?? '',
            'receiver' => $request->input('receiver') ?? '',
            'caller_name' => $request->input('caller_name') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'caller_number' => $request->input('caller_number') ?? '',
            'notification_originator' => $request->input('notification_originator') ?? '',
            'first_responding_engine' => $request->input('first_responding_engine') ?? '',
            'first_responding_leader' => $request->input('first_responding_leader') ?? '',
            'time_arrival_on_scene' => $request->input('time_arrival_on_scene') ?? '',
            'alarm_status_time' => $request->input('alarm_status_time') ?? '',
            'Time_Fire_out' => $request->input('Time_Fire_out') ?? '',
            'property_owner' => $request->input('property_owner') ?? '',
            'details' => $request->input('details') ?? '',
            'findings' => $request->input('findings') ?? '',
            'recommendation' => $request->input('recommendation') ?? '',
            'photos' => $photos ?? '',
        ]);
        $minimal->save();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $minimal->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Created a Minimal Investigation with a subject of " . $minimal->investigation->subject,
            'action' => "Store",
        ]);
        $log->save();
        return redirect()->back()->with("success", "Investigation Created Successfully!");
    }
    public function updateMinimal(Request $request, Minimal $minimal)
    {
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    // $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $inves = Investigation::findOrFail($minimal->investigation_id);
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'dt_actual_occurence' => 'required',
            'dt_reported' => 'required',
            'barangay' => 'nullable',
            'zone' => 'nullable',
            'landmark' => 'nullable',
            'involved_property' => 'required',
            'property_data' => 'required',
            'receiver' => 'required',
            'caller_name' => 'required',
            'caller_address' => 'required',
            'caller_number' => 'required',
            'notification_originator' => 'required',
            'first_responding_engine' => 'required',
            'first_responding_leader' => 'required',
            'time_arrival_on_scene' => 'required',
            'alarm_status_time' => 'required',
            'Time_Fire_out' => 'required',
            'property_owner' => 'required',
            'property_occupant' => 'required',
            'details' => 'nullable',
            'findings' => 'nullable',
            'recommendation' => 'nullable',
            'curPhoto' => 'nullable',
            'photos' => 'nullable',
            'case_number' => "required|unique:investigations,case_number,{$inves->id}",
        ]);

        // dd($validatedData, $request->all());

        // $inves = Investigation::findOrFail($minimal->investigation_id);
        $originalInvestigationData = $inves->getOriginal();
        $updateInve = [
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $validatedData['for'],
            'subject' => $validatedData['subject'],
            'date' => $validatedData['date'],
        ];
        $inves->touch();
        $inves->update($updateInve);

        // dd($inves);
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone')) {
            $location = $location . ', ' . $request->input('zone');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }

        $remainingPhotos = array();
        // $photos = explode(", ", $minimal->photos);
        // if ($request->has('curPhoto')) {
        # code...
        $photos = explode(", ", $minimal->photos);
        $currentPhotos = $validatedData['curPhoto'] ?? [];
        $photosToDelete = array_diff($photos, $currentPhotos);
        $remainingPhotos = array_intersect($photos, $currentPhotos);
        // dd($photos, $currentPhotos, $photosToDelete, $remainingPhotos);
        foreach ($photosToDelete as $photoToDelete) {
            if (Storage::disk('public')->exists('minimal/' . $photoToDelete)) {
                // dd("photo is found: " . $photoToDelete);
                try {
                    Storage::disk('public')->delete('minimal/' . $photoToDelete);
                } catch (\Throwable $th) {
                    abort(404, "Page not found");
                }
            }
        }
        // }   
        // dd("dead End");
        if ($validatedData['photos'] ?? false) {

            foreach ($validatedData['photos'] as $photo) {
                $filePath = baseName($photo->store('minimal', 'public'));
                $remainingPhotos[] = $filePath;
                // $fileName = baseName($file)
            }
        }
        $photos = implode(", ", $remainingPhotos);
        $originalData = $minimal->getOriginal();
        $updatedMinimal = [
            'dt_actual_occurence' => $request->input('dt_actual_occurence') ?? '',
            'dt_reported' => $request->input('dt_reported') ?? '',
            'barangay' => $request->input('barangay') ?? '',
            'street' => $request->input('zone') ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'incident_location' => $location ?? '',
            'involved_property' => $request->input('involved_property') ?? '',
            'property_data' => $request->input('property_data') ?? '',
            'property_occupant' => $request->input('property_occupant') ?? '',
            'receiver' => $request->input('receiver') ?? '',
            'caller_name' => $request->input('caller_name') ?? '',
            'caller_address' => $request->input('caller_address') ?? '',
            'caller_number' => $request->input('caller_number') ?? '',
            'notification_originator' => $request->input('notification_originator') ?? '',
            'first_responding_engine' => $request->input('first_responding_engine') ?? '',
            'first_responding_leader' => $request->input('first_responding_leader') ?? '',
            'time_arrival_on_scene' => $request->input('time_arrival_on_scene') ?? '',
            'alarm_status_time' => $request->input('alarm_status_time') ?? '',
            'Time_Fire_out' => $request->input('Time_Fire_out') ?? '',
            'property_owner' => $request->input('property_owner') ?? '',
            'details' => $request->input('details') ?? '',
            'findings' => $request->input('findings') ?? '',
            'recommendation' => $request->input('recommendation') ?? '',
            'photos' => $photos ?? '',
        ];
        $minimal->touch();
        $minimal->update($updatedMinimal);
        $changes = [];
        foreach ($updateInve as $key => $value) {
            if ($originalInvestigationData[$key] != $value) {
                $changes['investigation_' . $key] = [
                    'old' => $originalInvestigationData[$key],
                    'new' => $value,
                ];
            }
        }
        foreach ($updatedMinimal as $key => $value) {
            if ($originalData[$key] != $value) {
                $changes[$key] = [
                    'old' => $originalData[$key],
                    'new' => $value,
                ];
            }
        }
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $minimal->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => json_encode($changes),
            'action' => "Update",
        ]);
        $log->save();
        return redirect()->back()->with("success", $minimal->investigation->subject . " Updated Successfully!");
    }
    public function editSpot(Spot $spot)
    {
        if ($spot->landmark == null || $spot->landmark == "") {
            $location = $spot->address_occurence;
        } else {
            $location = $spot->landmark;
        }
        $station = Station::first();
        return view('reports.investigation.spot.edit', [
            'active' => 'spot',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'alarms' => Alarm_name::all(),
            'spot' => $spot,
            'location' => $location,
            'station' => $station,
        ]);
    }
    public function updateSpot(Request $request, Spot $spot)
    {
        // dd($request, $spot);
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    // $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $investigation = Investigation::findOrFail($spot->investigation_id);
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'date_occurence' => 'required',
            'time_occurence' => 'required',
            'barangay' => 'nullable',
            'zone_street' => 'nullable',
            'landmark' => 'nullable',
            'involved' => 'required',
            'name_of_establishment' => 'required',
            'owner' => 'required',
            'alarm' => 'required',
            'occupant' => 'required',
            'fatality' => 'required',
            'injured' => 'required',
            'estimate_damage' => 'required',
            'time_fire_start' => 'required',
            'time_fire_out' => 'required',
            'details' => 'required',
            'disposition' => 'required',
            'case_number' => "required|unique:investigations,case_number,{$investigation->id}",
        ]);

        $originalInvestigationData = $investigation->getOriginal();
        $updateInve = [
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $validatedData['for'],
            'subject' => $validatedData['subject'],
            'date' => $validatedData['date'],
        ];
        $investigation->touch();
        $investigation->update($updateInve);
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone_street')) {
            $location = $location . ', ' . $request->input('zone_street');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }
        $updatedSpot = [
            'date_occurence' => $validatedData['date_occurence'] ?? '',
            'time_occurence' => $validatedData['time_occurence'] ?? '',
            'barangay' => $validatedData['barangay'] ?? '',
            'street' => $validatedData['zone_street'] ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'address_occurence' => $location ?? '',
            'involved' => $validatedData['involved'] ?? '',
            'name_of_establishment' => $validatedData['name_of_establishment'] ?? '',
            'owner' => $validatedData['owner'] ?? '',
            'occupant' => $validatedData['occupant'] ?? '',
            'fatality' => $validatedData['fatality'] ?? '',
            'injured' => $validatedData['injured'] ?? '',
            'estimate_damage' => $validatedData['estimate_damage'] ?? '',
            'time_fire_start' => $validatedData['time_fire_start'] ?? '',
            'time_fire_out' => $validatedData['time_fire_out'] ?? '',
            'alarm' => $validatedData['alarm'] ?? '',
            'details' => $validatedData['details'] ?? '',
            'disposition' => $validatedData['disposition'] ?? '',
        ];
        $originalData = $spot->getOriginal();
        $spot->touch();
        $spot->update($updatedSpot);
        $changes = [];
        foreach ($updateInve as $key => $value) {
            if ($originalInvestigationData[$key] != $value) {
                $changes['investigation_' . $key] = [
                    'old' => $originalInvestigationData[$key],
                    'new' => $value,
                ];
            }
        }
        foreach ($updatedSpot as $key => $value) {
            if ($originalData[$key] != $value) {
                $changes[$key] = [
                    'old' => $originalData[$key],
                    'new' => $value,
                ];
            }
        }
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $spot->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => json_encode($changes),
            'action' => "Update",
        ]);
        $log->save();
        return redirect()->back()->with("success", $spot->investigation->subject . " Updated Successfully!");
    }
    public function editProgress(Request $request, Progress $progress)
    {
        // dd($request, $progress);
        $station = Station::first();
        return view('reports.investigation.progress.edit', [
            'active' => 'progress',
            'user' => Auth::user(),
            'barangay' => Barangay::all(),
            'progress' => $progress,
            'station' => $station
        ]);
    }
    public function updateProgress(Request $request, Progress $progress)
    {
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    // $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        // dd($request);
        $investigation = Investigation::findOrFail($progress->investigation_id);
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'authority' => 'required',
            'matters_investigated' => 'required',
            'facts_of_the_case' => 'required',
            'disposition' => 'required',
            'case_number' => "required|unique:investigations,case_number,{$investigation->id}",
        ]);
        $updateInve = [
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $validatedData['for'],
            'subject' => $validatedData['subject'],
            'date' => $validatedData['date'],
        ];
        $originalInvestigationData = $investigation->getOriginal();
        $investigation->touch();
        $investigation->update($updateInve);
        // dd($investigation);
        $updatedProg = [
            'authority' => $validatedData['authority'] ?? "",
            'matters_investigated' => $validatedData['matters_investigated'] ?? "",
            'facts_of_the_case' => $validatedData['facts_of_the_case'] ?? "",
            'disposition' => $validatedData['disposition'] ?? "",
        ];
        $originalData = $progress->getOriginal();
        $progress->touch();
        $progress->update($updatedProg);
        $changes = [];
        foreach ($updateInve as $key => $value) {
            if ($originalInvestigationData[$key] != $value) {
                $changes['investigation_' . $key] = [
                    'old' => $originalInvestigationData[$key],
                    'new' => $value,
                ];
            }
        }
        foreach ($updatedProg as $key => $value) {
            if ($originalData[$key] != $value) {
                $changes[$key] = [
                    'old' => $originalData[$key],
                    'new' => $value,
                ];
            }
        }
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $progress->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => json_encode($changes),
            'action' => "Update",
        ]);
        $log->save();
        return redirect()->back()->with("success", $progress->investigation->subject . " Updated Successfully!");
    }
    public function editFinal(Ifinal $final)
    {
        if ($final->landmark == null || $final->landmark == "") {
            $location = $final->place_of_fire;
        } else {
            $location = $final->landmark;
        }
        $td = explode(" ", $final->td_alarm);
        $victims = Victim::get()->where('investigation_id', $final->investigation_id);
        $station = Station::first();
        // dd($victims);
        return view('reports.investigation.final.edit', [
            'active' => 'final',
            'user' => Auth::user(),
            'final' => $final,
            'barangay' => Barangay::all(),
            'location' => $location,
            'td' => $td,
            'victims' => $victims,
            'station' => $station,
        ]);
    }
    public function updateFinal(Request $request, Ifinal $final)
    {
        // dd($request);
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    // $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $investigation = Investigation::find($final->investigation_id);
        $validatedData = $request->validate([
            'for' => 'required',
            'subject' => 'required',
            'date' => 'required|date',
            'intelligence_unit' => 'required',
            'barangay' => 'nullable',
            'zone_street' => 'nullable',
            'landmark' => 'nullable',
            'time_alarm' => 'required',
            'date_alarm' => 'required',
            'establishment_burned' => 'required',
            'damage_to_property' => 'required',
            'victim' => 'nullable',
            'origin_of_fire' => 'required',
            'cause_of_fire' => 'required',
            'substantiating_documents' => 'required',
            'facts_of_the_case' => 'required',
            'discussion' => 'required',
            'findings' => 'required',
            'recommendation' => 'required',
            'case_number' => "required|unique:investigations,case_number,{$investigation->id}"
        ]);
        // dd($validatedData);

        $originalInvestigationData = $investigation->getOriginal();
        $location = "";
        if ($request->input('landmark')) {
            $location = $request->input('landmark');
        }
        if ($request->input('zone_street')) {
            $location = $location . ', ' . $request->input('zone_street');
        }
        if ($request->input('barangay')) {
            $location = $location . ', ' . $request->input('barangay') . ', Ligao City, Albay';
        }
        $td = ($request->input('time_alarm') ?? '') . " " . ($request->input('date_alarm') != null ? date('Y-m-d', strtotime($request->input('date_alarm'))) : '');
        $updateInve = [
            'case_number' => $validatedData['case_number'] ?? "",
            'for' => $validatedData['for'] ?? '',
            'subject' => $validatedData['subject'] ?? '',
            'date' => $validatedData['date'] != null ? date('Y-m-d', strtotime($validatedData['date'])) : '',
        ];
        $investigation->touch();
        $investigation->update($updateInve);
        Victim::where('investigation_id', $final->investigation_id)->delete();
        if ($request->input('victim')) {
            foreach ($request->input('victim') as $victi) {
                # code...
                $victim = new Victim();
                $victim->investigation_id = $investigation->id;
                $victim->name = $victi;
                $victim->save();
            }
        }
        // dd(Victim::all());
        // dd($investigation);
        $updateFinal = [
            'investigation_id' => $investigation->id,
            'intelligence_unit' => $request->input('intelligence_unit') ?? '',
            'barangay' => $request->input('barangay') ?? '',
            'street' => $request->input('zone_street') ?? '',
            'landmark' => $request->has('barangay') ? $request->input('landmark') : '',
            'place_of_fire' => $location ?? '',
            'td_alarm' => $td ?? '',
            'establishment_burned' => $request->input('establishment_burned') ?? '',
            'damage_to_property' => $request->input('damage_to_property') ?? '',
            'origin_of_fire' => $request->input('origin_of_fire') ?? '',
            'cause_of_fire' => $request->input('cause_of_fire') ?? '',
            'substantiating_documents' => $request->input('substantiating_documents') ?? '',
            'facts_of_the_case' => $request->input('facts_of_the_case') ?? '',
            'discussion' => $request->input('discussion') ?? '',
            'findings' => $request->input('findings') ?? '',
            'recommendation' => $request->input('recommendation') ?? '',
        ];
        // dd($spot);
        $originalData = $final->getOriginal();
        $final->update($updateFinal);
        $changes = [];
        foreach ($updateInve as $key => $value) {
            if ($originalInvestigationData[$key] != $value) {
                $changes['investigation_' . $key] = [
                    'old' => $originalInvestigationData[$key],
                    'new' => $value,
                ];
            }
        }
        foreach ($updateFinal as $key => $value) {
            if ($originalData[$key] != $value) {
                $changes[$key] = [
                    'old' => $originalData[$key],
                    'new' => $value,
                ];
            }
        }
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $final->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => json_encode($changes),
            'action' => "Update",
        ]);
        $log->save();
        return redirect()->back()->with("success", $final->investigation->subject . " Updated Successfully!");
    }

    public function destroyMinimal(Request $request)
    {
        // dd($request->all());
        $extension = ".";
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $minimal = Minimal::findOrFail($request->input('id'));
        $investigation = Investigation::findOrFail($minimal->investigation_id);
        // if ($minimal->photos !== null) {
        //     $photos = explode(", ", $minimal->photos);
        //     // dd($photos);
        //     foreach ($photos as $photoToDelete) {
        //         if (Storage::disk('public')->exists('minimal/' . $photoToDelete)) {
        //             // dd("photo is found: " . $photoToDelete);
        //             try {
        //                 Storage::disk('public')->delete('minimal/' . $photoToDelete);
        //             } catch (\Throwable $th) {
        //                 abort(404, "Page not found");
        //             }
        //         }
        //     }
        // }
        // $minimal->delete();
        $investigation->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $investigation->touch();
        $investigation->save();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $minimal->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Deleted a Minimal Investigation with a subject of " . $minimal->investigation->subject . ", Created on " . $minimal->investigation->date . $extension,
            'action' => "Delete",
        ]);
        $log->save();
        return redirect()->back()->with('success', 'Investigation Deleted Successfully');
        // dd($minimal);
    }
    public function destroySpot(Request $request)
    {
        $extension = ".";
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $spot = Spot::findOrFail($request->input('id'));
        $investigation = Investigation::findOrFail($spot->investigation_id);
        // $spot->delete();
        // $investigation->delete();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $spot->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Deleted a Spot Investigation with a subject of " . $spot->investigation->subject . ", Created on " . $spot->investigation->date . $extension,
            'action' => "Delete",
        ]);
        $log->save();
        $investigation->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $investigation->touch();
        $investigation->save();
        return redirect()->back()->with('success', 'Investigation Deleted Successfully');
    }
    public function destroyProgress(Request $request)
    {
        $extension = ".";
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $progress = Progress::findOrFail($request->input('id'));
        $investigation = Investigation::findOrFail($progress->investigation_id);
        // $progress->delete();
        // $investigation->delete();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $progress->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Deleted a Progress Investigation with a subject of " . $progress->investigation->subject . ", Created on " . $progress->investigation->date . "$extension",
            'action' => "Delete",
        ]);
        $log->save();
        $investigation->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $investigation->touch();
        $investigation->save();
        return redirect()->back()->with('success', 'Investigation Deleted Successfully');
    }
    public function destroyFinal(Request $request)
    {
        $extension = ".";
        if (auth()->user()->privilege == 'investigation_clerk') {
            # code...
            $passcodes = Passcode::all();
            $passcodeStatus = false;
            foreach ($passcodes as $passcode) {
                if ($request->input('passcode') == $passcode->code) {
                    $passcodeStatus = true;
                    $extension = ", Using this passcode: <b>" . $passcode->code . "</b>. Generated by <b>" . $passcode->creator->username . "</b>.";
                    $passcode->delete();
                    break; // Stop checking once a match is found
                }
            }
            if (!$passcodeStatus) {
                return redirect()->back()->with('status', "Passcode doesn't match.");
            }
            // dd($passcodeStatus, $passcode);
        }
        $final = Ifinal::findOrFail($request->input('id'));
        $investigation = Investigation::findOrFail($final->investigation_id);
        // $final->delete();
        // $investigation->delete();
        $log = new InvestigationLog();
        $log->fill([
            'investigation_id' => $final->investigation->id,
            'user_id' => auth()->user()->id,
            'details' => "Deleted a Final Investigation with a subject of " . $final->investigation->subject . ", Created on " . $final->investigation->date . $extension,
            'action' => "Delete",
        ]);
        $log->save();
        $investigation->deleted_at = Carbon::now()->format('Y-m-d H:i:s');
        $investigation->touch();
        $investigation->save();
        return redirect()->back()->with('success', 'Investigation Deleted Successfully');
    }
    public function printSpot(Spot $spot)
    {
        // dd($spot);
        $station = Station::first();
        return view('reports.investigation.spot.printable', [
            'active' => 'spot',
            'user' => Auth::user(),
            'spot' => $spot,
            'station' => $station,
        ]);
    }
    public function printMinimal(Minimal $minimal)
    {
        // dd($spot);
        $station = Station::first();
        return view('reports.investigation.minimal.printable', [
            'active' => 'minimal',
            'user' => Auth::user(),
            'minimal' => $minimal,
            'station' => $station
        ]);
    }
    public function printProgress(Progress $progress)
    {
        $station = Station::first();
        return view('reports.investigation.progress.printable', [
            'active' => 'progress',
            'user' => Auth::user(),
            'progress' => $progress,
            'station' => $station
        ]);
    }
    public function printFinal(Ifinal $final)
    {
        $station = Station::first();
        return view('reports.investigation.final.printable', [
            'active' => 'final',
            'user' => Auth::user(),
            'final' => $final,
            'station' => $station,
        ]);
    }
}
