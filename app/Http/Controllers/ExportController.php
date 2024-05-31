<?php

namespace App\Http\Controllers;

use App\Exports\SpotExport;
use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Exports\MinimalExport;
use Maatwebsite\Excel\Facades\Excel;

class exportController extends Controller
{
    //
    public function exportInvestigation(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'Type' => 'required|string',
            'dateFrom' => 'required|date_format:Y-m-d',
            'dateTo' => 'required|date_format:Y-m-d|after_or_equal:dateFrom',
        ]);

        // dd($validated['dateFrom']);
        $status = "AN ERRORED OCCURED \n";
        if ($validated['Type'] == "Minimal" || $validated['Type'] == "All") {
            $investigations = Investigation::has('Minimal')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
            $exportFileName = 'Minimal Investigation.xlsx';
            try {
                return Excel::download(new MinimalExport($investigations), $exportFileName);
            } catch (\Exception  $e) {
                // $status = count($investigations);
                $status = $status . "\nMinimal: ";
                // dd($status);
                if (count($investigations) != 0) {
                    $status = $status . $e . " \n ";
                    # code...
                } else {
                    $status = $status . "O Data \n ";
                }
            }
        }

        if ($validated['Type'] == "Spot" || $validated['Type'] == "All") {
            $investigations = Investigation::has('Spot')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
            $exportFileName = 'Spot Investigation.xlsx';
            try {
                return Excel::download(new SpotExport($investigations), $exportFileName);
            } catch (\Exception  $e) {
                // $status = count($investigations);
                $status = $status . "\nSpot: ";
                // dd($status);
                if (count($investigations) != 0) {
                    $status = $status . $e . " \n ";
                    # code...
                } else {
                    $status = $status . "O Data \n ";
                }
            }
        }
        if ($validated['Type'] == "Progress" || $validated['Type'] == "All") {
            $investigations = Investigation::has('progress')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        }
        if ($validated['Type'] == "Final" || $validated['Type'] == "All") {
            $investigations = Investigation::has('final')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        }

        if ($status != "") {
            $status = "AN ERRORED OCCURED \n" . $status;
            return redirect()->back()->with("status", $status);
        } else {
            return redirect()->back()->with("success", 'Successfully Exported');
        }


        // dd($investigations);

    }
}
