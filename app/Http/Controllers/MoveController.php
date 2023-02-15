<?php

namespace App\Http\Controllers;

use App\Models\Move;
use Illuminate\Http\Request;

class MoveController extends Controller
{
    public function index()
    {
        return view("admin.move", [
            "moves" => Move::all()
        ]);
    }
}
