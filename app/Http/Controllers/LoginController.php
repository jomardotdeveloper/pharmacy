<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view("admin.login");
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $credentials = [
            "username" => $validated["username"],
            "password" => $validated["password"]
        ];

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            $user = Auth::user();
            Log::create([
                "user_id" => $user->id,
                "action" => "login"
            ]);
            if($user->role == "cashier")
                return redirect()->intended("/shop");
            return redirect()->intended("/dashboard");
        }

        return back()->withErrors([
            "login-error" => "The provided credentials do not match our records."
        ]);
    }
}
