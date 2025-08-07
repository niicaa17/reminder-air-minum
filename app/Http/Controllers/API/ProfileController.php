<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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

    public function editPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8'
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return response()->json(['message' => 'Password saat ini salah'], 403);
        }

        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password berhasil diubah']);
    }

    public function editEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->user()->id
        ]);

        $user = $request->user();
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'Email berhasil diubah']);
    }

    public function editName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return response()->json(['message' => 'Nama berhasil diubah']);
    }
}