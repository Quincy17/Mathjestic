<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use App\Models\LogsModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data statistik untuk dashboard
        $totalSoal = SoalModel::count();
        $totalUnduhan = LogsModel::where('activity', 'download_soal')->count();
        $totalLogs = LogsModel::count();
        $logs = LogsModel::latest()->take(10)->get();

        $soalPerBulan = SoalModel::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month"))
            ->groupBy('month')
            ->orderBy(DB::raw("STR_TO_DATE(month, '%M')"), 'asc')
            ->pluck('count', 'month');

        return view('admin.dashboard', compact('totalSoal', 'totalUnduhan', 'totalLogs', 'logs','soalPerBulan'));
    }

    public function logs()
    {
        $logs = LogsModel::latest()->paginate(20);
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
