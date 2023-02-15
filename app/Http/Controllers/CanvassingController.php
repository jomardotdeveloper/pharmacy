<?php

namespace App\Http\Controllers;

use App\Models\Canvassing;
use App\Models\CanvassingLine;
use App\Models\Move;
use App\Models\Out;
use App\Models\OutParent;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseParent;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CanvassingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Canvassing::all();
        return view("admin.canvassing.index", compact("parents"));
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
        return view("admin.canvassing.create", compact("suppliers", "products"));
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
        $parent = Canvassing::create([
            "user_id" => auth()->user()->id,
            "supplier_id" => $request->supplier_id,
        ]);
        
        foreach ($ids as $id) {

            $purchase = CanvassingLine::create([
                "parent_id" => $parent->id,
                "product_id" => $values["product_id_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "cost" => $values["cost_" . strval($id)],
                "total_cost" => floatval($values["quantity_" . strval($id)]) * floatval($values["cost_" . strval($id)]), 
                "expiration_date" => $values["expiration_date_" . strval($id)],
            ]);

        }
        return redirect()->route("canvassings.show", ["canvassing" => $parent]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Canvassing $canvassing)
    {
        return view("admin.canvassing.show", compact("canvassing"));
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
    public function update(Request $request, Canvassing $canvassing)
    {
        $values = $request->all();
        $parent = PurchaseParent::create([
            "user_id" => $canvassing->user_id,
            "supplier_id" => $canvassing->supplier_id,
        ]);

        $outParent = OutParent::create(["user_id" => $canvassing->user_id]);
        foreach($canvassing->lines as $line){
            $stock = Stock::create([
                "product_id" => $line->product_id,
                "expiration_date" => $line->expiration_date,
                "quantity" => $line->quantity,
                "supplier_id" => $canvassing->supplier_id
            ]);

            $out = Out::create([
                "parent_id" => $outParent->id,
                "product_id" =>  $line->product_id,
                "expiration_date" =>  $line->expiration_date,
                "quantity" =>  $line->quantity,
                "supplier_id" =>$canvassing->supplier_id
            ]);

            $purchase = Purchase::create([
                "parent_id" => $parent->id,
                "product_id" => $line->product_id,
                "quantity" =>$line->quantity,
                "cost" => $line->cost,
                "total_cost" => floatval($line->quantity) * floatval($line->cost), 
                "stock_id" => $stock->id,
            ]);

            Move::create([
                "product_id" => $line->product_id,
                "quantity" =>  $line->quantity,
                "is_in" => true,
                "source" => $parent->formatted_number,
            ]);
        }

        return redirect()->route("procurements.show", ["procurement" => $parent]);
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
