<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view("admin.setting.setting", ["setting" => Setting::first()]);
    }

    public function update(Request $request)
    {
        $current = Setting::first();
       
        $current->update(["void_password" => $request->void_password]);
        return redirect("/settings")->withErrors([
            "success-window" => "Void password updated successfully."
        ]);
    }
}
