<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $logs = DailyLog::with(['tasks', 'user'])
                ->whereHas('user', function ($query) {
                    $query->whereIn('role_id', [2, 3]);
                })
                ->get();
        } else if (auth()->user()->role_id == 2) {
            $logs = DailyLog::with(['tasks', 'user'])
                ->whereHas('user', function ($query) {
                    $query->where('role_id', 4);
                })
                ->get();
        } else if (auth()->user()->role_id == 3) {
            $logs = DailyLog::with(['tasks', 'user'])
                ->whereHas('user', function ($query) {
                    $query->where('role_id', 5);
                })
                ->get();
        } else {
            $logs = DailyLog::with(['tasks', 'user'])
                ->where('user_id', auth()->user()->id)
                ->get();
        }
        return view('pages.dashboard.index', [
            'logs' => $logs,
            'title' => 'Dashboard'
        ]);
    }

    public function create()
    {
        if (auth()->user()->role_id == 1) {
            $users = User::whereIn('role_id', [2, 3])
                ->get();
        } else if (auth()->user()->role_id == 2) {
            $users = User::where('role_id', 4)
                ->get();
        } else if (auth()->user()->role_id == 3) {
            $users = User::where('role_id', 5)
                ->get();
        } else {
            $logs = [];
        }
        return view('pages.dashboard.create', ['users' => $users, 'title' => 'Daily Log', 'desc' => 'Daily Log']);
    }

    public function monitor(Request $request)
    {
        try {
            $logs = DailyLog::create([
                'date' => Carbon::parse($request->date),
                'user_id' => $request->user_id
            ]);

            $title  = $request->title;
            $is_done  = $request->is_done;
            $log_id  = $logs->id;
            for ($i = 0; $i < count($title); $i++) {
                $datasave = [
                    'title' => $title[$i],
                    'is_done' => $is_done[$i],
                    'log_id' => $log_id
                ];
                $daily_log = Task::create($datasave);
            }
            return redirect('/dashboard')->with('success', 'Daily log berhasil ditambahkan!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Daily log gagal disimpn!');
        }
    }
}