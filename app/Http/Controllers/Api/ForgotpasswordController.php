<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Models\auth\User;
use Illuminate\Support\Facades\Password;


class ForgotpasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $emailData = $request->only('email');

        try {
            $status = Password::sendResetLink($emailData);

            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'status' => true,
                    'message' => __($status)
                ], 200);
            }

            return response()->json([
                'status' => false,
                'error' => __($status)
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric',
            'password' => 'required|string|min:8',
        ]);

        $email = $request->email;
        $code = $request->code;
        $newPassword = $request->password;

    
        $cachedCode = Cache::get('password_reset_code_' . $email);

        if ($cachedCode && $cachedCode == $code) {
        
            $user = User::where('email', $email)->first();

            if ($user) {
                
                $user->password = Hash::make($newPassword);
                $user->save();

           
                Cache::forget('password_reset_code_' . $email);

                return response()->json([
                    'status' => true,
                    'message' => 'Password has been reset successfully.'
                ], 200);
            }

            return response()->json([
                'status' => false,
                'error' => 'User not found.'
            ], 404);
        }

        return response()->json([
            'status' => false,
            'error' => 'Invalid or expired code.'
        ], 400);
    }
}
