<?php

namespace App\Http\Controllers;

use App\Models\AforLog;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\InvestigationLog;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function logsInvestigationIndex()
    {
        $user = Auth::user();
        $station = Station::first();
        return view('admin.logs.investigation.viewLogs', [
            'active' => 'viewInvestigationLogs',
            'user' => $user,
            'logs' => InvestigationLog::all(),
            'station' => $station
        ]);
    }

    public function logsOperationIndex()
    {
        $user = Auth::user();
        $station = Station::first();
        return view('admin.logs.operation.viewLogs', [
            'active' => 'viewOperationLogs',
            'user' => $user,
            'logs' => AforLog::orderBy('created_at', 'desc')->get(),
            'station' => $station,
            
        ]);
    }
}
