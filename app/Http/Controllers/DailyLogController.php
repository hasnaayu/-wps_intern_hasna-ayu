<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyLogController extends Controller
{
    public function index(Request $request)
    {
        $fromdate = $request->start_date;
        $todate = $request->end_date;
        if ($request->start_date != '') {
            $logs = DailyLog::whereBetween('date', [$fromdate, $todate])
                ->get();
        } else {
            $logs = DailyLog::get();
        }
        return view('pages.daily_log.index', ['logs' => $logs, 'title' => 'Daily Log', 'desc' => 'Daily Log']);
    }

    public function create(Request $request)
    {
        return view('pages.daily_log.create', ['title' => 'Add Daily Log', 'desc' => 'Add Daily Log']);
    }

    public function store(Request $request)
    {
        try {
            $logs = DailyLog::create([
                'date' => Carbon::parse($request->date),
                'user_id' => auth()->user()->id
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
            return redirect('/dashboard/log')->with('success', 'Daily log berhasil ditambahkan!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Daily log gagal disimpan!');
        }
    }

    public function logDetail(Request $request, $id)
    {
        try {
            $task = Task::where('log_id', $id)->get();
            return response()->json([
                'success' => true,
                'data' => $task,
                'message' => 'Berhasil menampilkan data!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => true,
                'message' => 'Gagal menampilkan data! ' . $exception->getMessage()
            ]);
        }
    }

    public function isDoneTask($id)
    {
        $task = Task::select('is_done')->where('id', '=', $id)->first();

        if ($task->is_done == '1') {
            $is_done = '0';
        } else {
            $is_done = '1';
        }

        $values = array('is_done' => $is_done);
        Task::where('id', $id)->update($values);

        return back();
    }

    public function edit(Request $request, $id)
    {
        $log = DailyLog::with('tasks')->where('id', $id)->first();
        return view('pages.daily_log.edit', ['log' => $log, 'title' => 'Edit Daily Log', 'desc' => 'Edit Daily Log']);
    }

    public function delete($id)
    {
        $log = DailyLog::where('id', $id)->first();
        $log->delete();

        $task = Task::where('log_id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data daily log!'
        ]);
    }

    public function checkLog(Request $request)
    {
        if (auth()->user()->role_id == 1) {
            $logs = DailyLog::with('tasks')
                ->whereHas('user', function ($query) {
                    $query->whereIn('role_id', [2, 3]);
                })
                ->get();
        } else if (auth()->user()->role_id == 2) {
            $logs = DailyLog::with('tasks')
                ->whereHas('user', function ($query) {
                    $query->where('role_id', 4);
                })
                ->get();
        } else if (auth()->user()->role_id == 3) {
            $logs = DailyLog::with('tasks')
                ->whereHas('user', function ($query) {
                    $query->where('role_id', 5);
                })
                ->get();
        } else {
            $logs = [];
        }
        return view('pages.daily_log.checking.index', ['logs' => $logs, 'title' => 'Daily Log', 'desc' => 'Daily Log']);
    }

    public function acceptLog($id)
    {
        $log = DailyLog::where('id', $id)->first();
        $log->update(['status' => 'approved']);

        return redirect('/dashboard/log/check-log')->with('success', 'Daily log berhasil disetujui!');
    }

    public function rejectLog($id)
    {
        $log = DailyLog::where('id', $id)->first();
        $log->update(['status' => 'rejected']);

        return redirect('/dashboard/log/check-log')->with('success', 'Daily log berhasil ditolak!');
    }

}