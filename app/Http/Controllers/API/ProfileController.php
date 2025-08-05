<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateTarget(Request $request)
    {
        $request->validate([
            'daily_target' => 'required|integer|min:500|max:5000'
        ]);

        $user = $request->user();
        $user->daily_target = $request->daily_target;
        $user->save();

        return response()->json([
            'message' => 'Target harian berhasil diubah',
            'daily_target' => $user->daily_target
        ]);
    }
}