<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\ConfigurationLog;
use Illuminate\Support\Facades\Auth;

class ConfigurationLogController extends Controller
{
    public function index() {
        $user = Auth::user();
        $active = "configurationLog";
        $logs = ConfigurationLog::all();
        $station = Station::first();
        return view('admin.logs.configuration.viewLogs', compact('user', 'active', 'logs', 'station'));
    }
}
