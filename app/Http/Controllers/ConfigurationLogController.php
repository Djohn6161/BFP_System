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
        $logs = ConfigurationLog::orderBy('created_at', 'desc')->where("type", "!=", "personnel")->get();
        $station = Station::first();
        return view('admin.logs.configuration.viewLogs', compact('user', 'active', 'logs', 'station'));
    }
    public function logsAdminIndex(){
        $user = Auth::user();
        $stations = Station::first();
        return view("admin.logs.admin.viewLogs",[
            'active' => 'viewAdminLogs',
            'user' => $user,
            'logs' => ConfigurationLog::orderBy('created_at', 'desc')->where("type", "personnel")->get(),
            'station' => $stations,
        ]);
    }
}
