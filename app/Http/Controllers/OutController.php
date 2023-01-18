<?php

namespace App\Http\Controllers;

use App\Models\OutParent;
use Illuminate\Http\Request;

class OutController extends Controller
{
    public function out()
    {
        return view("admin.out.out", [
            "outs" => OutParent::all()
        ]);
    }

    public function show($id)
    {
        $parent = OutParent::find($id);
        return view("admin.out.show", [
            "out" => $parent,
            "outs" => $parent->outs
        ]);
    }
}
