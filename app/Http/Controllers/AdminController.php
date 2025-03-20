<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use App\Models\LogsModel;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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

        // Jika ada kolom yang mencatat unduhan di logs
        $totalUnduhan = LogsModel::where('activity', 'download')->count();

        return view('admin.data-website', compact('totalSoal', 'totalLogs', 'totalUnduhan'));
    }
}
