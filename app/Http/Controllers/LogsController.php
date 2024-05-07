<?php

namespace App\Http\Controllers;

use App\Models\AforLog;
use App\Models\InvestigationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function logsInvestigationIndex()
    {
        $user = Auth::user();

        return view('admin.logs.investigation.viewLogs', [
            'active' => 'viewLogs',
            'user' => $user,
            'logs' => InvestigationLog::all(),
        ]);
    }

    public function logsOperationIndex()
    {
        $user = Auth::user();

        return view('admin.logs.operation.viewLogs', [
            'active' => 'viewLogs',
            'user' => $user,
            'logs' => AforLog::all(),
            
        ]);
    }
}
