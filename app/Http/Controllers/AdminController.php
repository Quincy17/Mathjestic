<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use App\Models\LogsModel;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data statistik untuk dashboard
        $totalSoal = SoalModel::count();
        $totalUnduhan = LogsModel::where('activity', 'download_soal')->count();
        $totalLogs = LogsModel::count();
        $logs = LogsModel::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalSoal', 'totalUnduhan', 'totalLogs', 'logs'));
    }

    public function logs()
    {
        $logs = LogsModel::latest()->paginate(10);
        return view('admin.logs', compact('logs'));
    }

    public function dataWebsite()
    {
        $totalSoal = SoalModel::count();
        $totalLogs = LogsModel::count();
        $totalUnduhan = LogsModel::where('activity', 'download_soal')->count();

        return view('admin.data-website', compact('totalSoal', 'totalLogs', 'totalUnduhan'));
    }
}
