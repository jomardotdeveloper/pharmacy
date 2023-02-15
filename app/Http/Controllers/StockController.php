<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Move;
use App\Models\Out;
use App\Models\OutParent;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.stock.index", [
            "stocks" => Stock::all(),
            "categories" => Category::all(),
            "suppliers" => Supplier::all(),
            "products" => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.stock.create", [
            "products" => Product::all(),
            "suppliers" => Supplier::all()
        ]);
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
        $count = 0;
        $outParent = OutParent::create(["user_id" => auth()->user()->id]);
        $outParent->save();
        foreach ($ids as $id) {
            $stock = Stock::create([
                "product_id" => $values["product_id_" . strval($id)],
                "expiration_date" => $values["expiration_date_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "supplier_id" => $values["supplier_id_" . strval($id)]
            ]);
            
            Move::create([
                "product_id" => $values["product_id_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "is_in" => True,
                "source" => "Inventory Adjusment"
            ]);

            $out = Out::create([
                "parent_id" => $outParent->id,
                "product_id" => $values["product_id_" . strval($id)],
                "expiration_date" => $values["expiration_date_" . strval($id)],
                "quantity" => $values["quantity_" . strval($id)],
                "supplier_id" => $values["supplier_id_" . strval($id)]
            ]);

            $out->save();
            $stock->save();
            $count = $count + intval($values["quantity_" . strval($id)]);
        }

        return redirect("/stocks")->withErrors([
            "success-window" => "$count Products has been added to your inventory."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view("admin.stock.show", [
            "stock" => $stock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view("admin.stock.edit", [
            "products" => Product::all(),
            "suppliers" => Supplier::all(),
            "stock" => $stock
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $isIn = $stock->quantity < $request->get("quantity");
        // CURRENT STOCK : 25

        // INPUT : 30
        $stock->fill($request->all());
        $stock->save();

        Move::create([
            "product_id" => $stock->product_id,
            "quantity" => $request->get("quantity"),
            "is_in" => $isIn,
            "source" => "Inventory Adjusment"
        ]);


        return redirect()->route("stocks.show", [
            "stock" => $stock
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route("stocks.index");
    }
}
