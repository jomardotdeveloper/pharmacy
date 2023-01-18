<?php

namespace App\Http\Controllers;

use App\Models\Out;
use App\Models\OutParent;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseParent;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = PurchaseParent::all();
        return view("admin.procurement.index", compact("parents"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view("admin.procurement.create", compact("suppliers", "products"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids = explode(",", $request->get("ids"));
        $values = $request->all();
        $parent = PurchaseParent::create([
            "purchase_date" => $request->purchase_date,
            "user_id" => auth()->user()->id,
            "supplier_id" => $request->supplier_id,
        ]);
        $outParent = OutParent::create(["user_id" => auth()->user()->id]);
        

        foreach ($ids as $id) {
            $stock = Stock::create([
                "product_id" => $values["product_id_" . strval($id)],
                "expiration_date" => $values["expiration_date_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "supplier_id" => $request->supplier_id
            ]);

            $out = Out::create([
                "parent_id" => $outParent->id,
                "product_id" => $values["product_id_" . strval($id)],
                "expiration_date" => $values["expiration_date_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "supplier_id" => $request->supplier_id
            ]);

            $purchase = Purchase::create([
                "parent_id" => $parent->id,
                "product_id" => $values["product_id_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "cost" => $values["cost_" . strval($id)],
                "total_cost" => floatval($values["quantity_" . strval($id)]) * floatval($values["cost_" . strval($id)]), 
                "stock_id" => $stock->id,
            ]);
        }
        return redirect()->route("procurements.show", ["procurement" => $parent]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseParent $procurement)
    {
        return view("admin.procurement.show", compact("procurement"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
