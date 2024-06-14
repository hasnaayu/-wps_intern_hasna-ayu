<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('pages.auth.login', ['title' => 'Login']);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $existing_user = User::where('email', $request->email)->where('is_active', 1)->first();
            if ($existing_user) {
                if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
                    $user = User::where('id', Auth::id())
                        ->where('is_active', 1)
                        ->with('role')
                        ->first();
                    return response()->json([
                        'success' => true,
                        'role' => $user->role->name,
                        'message' => 'Berhasil login!'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Pastikan password yang Anda masukkan benar!'
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak ditemukan!'
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Oops! Something wrong! Code : ' . $exception->getMessage()
            ]);
        }
    }

    public function logout()
    {
        try {
            Session::flush();

            Auth::logout();

            return redirect('/');
        } catch (\Exception $exception) {
            return redirect('dashboard');
        }
    }
}
