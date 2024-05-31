<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigation;
use App\Exports\InvestigationExport;
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
        if ($validated['Type'] == "Minimal") {
            $investigations = Investigation::has('Minimal')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        } else if ($validated['Type'] == "Spot") {
            $investigations = Investigation::has('Spot')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        } else if ($validated['Type'] == "Progress") {
            $investigations = Investigation::has('progress')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        } else if ($validated['Type'] == "Final") {
            $investigations = Investigation::has('final')->whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        } else {
            $investigations = Investigation::whereBetween('date', [$validated['dateFrom'], $validated['dateTo']])->get();
        }
        $exportFileName = $validated['Type'] . ' Investigation.xlsx';
        // dd($investigations);
        try {
            return Excel::download(new InvestigationExport($investigations), $exportFileName);
        } catch (\Throwable $th) {
            $status = count($investigations);
            dd($status);
           return redirect()->back()->with('status', 'There is no data available or an error occured');
        }
    }
}
