<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleParent;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    //
    public function sale()
    {
        return view("admin.sale.sale", [
            "sales" => SaleParent::all()
        ]);
    }

    public function show($id)
    {
        $parent = SaleParent::find($id);
        return view("admin.sale.show", [
            "sale" => $parent,
            "sales" => $parent->sales
        ]);
    }
}
