<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaterLog;

class WaterLogController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $logs = WaterLog::query()
            ->where('user_id', $user->id)
            ->whereDate('logged_at', today())
            ->orderByDesc('logged_at')
            ->get();

        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
            'logged_at' => ['nullable', 'date'],
        ]);

        $log = WaterLog::create([
            'user_id' => $request->user()->id,
            'amount' => $validated['amount'],
            'logged_at' => $validated['logged_at'] ?? now(),
        ]);

        return response()->json([
            'message' => 'Log berhasil ditambahkan!',
            'log' => $log,
        ]);
    }

    public function destroy($id, Request $request)
    {
        $log = WaterLog::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $log->delete();

        return response()->json(['message' => 'Log berhasil dihapus']);
    }

    public function todayTotal(Request $request)
    {
        $user = $request->user();

        $total = Waterlog::where('user_id', $user->id)
            ->whereDate('logged_at', now()->toDateString())
            ->sum('amount');

        return response()->json([
            'date' => now()->toDateString(),
            'total_consumption_ml' => $total
        ]);
    }

    public function todayProgress(Request $request)
    {
        $user = $request->user();

        $total = Waterlog::where('user_id', $user->id)
            ->whereDate('logged_at', now()->toDateString())
            ->sum('amount');

        $target = $user->daily_target;
        $percentage = $target > 0 ? round(($total / $target) * 100, 2) : 0;

        return response()->json([
            'date' => now()->toDateString(),
            'total_consumption_ml' => $total,
            'daily_target_ml' => $target,
            'progress_percentage' => $percentage // e.g., 65.50 (%)
        ]);
    }

    public function getAllLogs(Request $request)
    {
        $user = $request->user();

        $logs = WaterLog::where('user_id', $user->id)
            ->orderByDesc('logged_at')
            ->get();

        return response()->json($logs);
    }
}