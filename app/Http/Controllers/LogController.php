<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        return view("admin.log.index", [
            "logs" => Log::all()
        ]);
    }
}
