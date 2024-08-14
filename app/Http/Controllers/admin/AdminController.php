<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\auth\User;
class AdminController extends Controller
{
    public function adminlogin()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
    
        if (!Auth::guard('web')->attempt($credentials)) {
            return response()->json(['status' => false, 'message' => 'Email & password does not match'], 401);
        }
    
        $user = Auth::guard('web')->user();
        if ($user->role === 'admin') {
            $token = $user->createToken('Admin API Token')->plainTextToken;
            return redirect()->route('admin.dashboard')->with('token', $token);
        }
        Auth::guard('web')->logout();
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        if ($request->user() && $request->user()->tokens()) {
            $request->user()->tokens()->delete();
        }

        return redirect()->route('login')->with('message', 'Successfully logged out');
    }
}
