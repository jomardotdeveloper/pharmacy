<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleParent;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function shop()
    {
        return view("admin.shop.shop", [
            "products" => $this->getAvailableProducts(),
            "discounts" => Discount::all(),
            "taxes" => Tax::all(),
            "void_password" => Setting::first()->void_password
        ]);
    }

    public function getAvailableProducts()
    {
        $availableProducts = [];
        $allProducts = Product::all();

        if (count($allProducts) < 1) {
            return [];
        }

        foreach ($allProducts as $product) {
            if ($product->item_stocks > 0) {
                array_push($availableProducts, $product);
            }
        }

        return ProductResource::collection($availableProducts);
    }

    public function checkout(Request $request)
    {
        // return $request->all();
        $parent = SaleParent::create([
            "payment" => $request->get("payment"),
            "change" => $request->get("change"),
            "user_id" => auth()->user()->id,
            "discount" => $request->get("discount") == "NULL" ? 0 : $request->get("discount"),
            "tax" => $request->get("tax") == "NULL" ? 0 : $request->get("tax"),
        ]);
        $parent->save();

        $stocks = null;

        foreach ($request->get("products") as $product) {
            $sale = Sale::create([
                "parent_id" => $parent->id,
                "product_id" => $product["product"]["id"],
                "quantity" => $product["quantity"],
                "cost" => $product["singleCost"],
                "unit" => $product["unit"]["val"],
                "total_cost" => $product["cost"]
            ]);
            $currentProduct = Product::find($product["product"]["id"]);
            $stocks = Stock::item($currentProduct->id)->notExpired()->get()->all();
            $currentQuantity = intval($product["quantity"]) * intval($product["unit"]["qty"]);

            foreach ($stocks as $stock) {
                if ($stock->quantity > $currentQuantity) {
                    $res = Stock::find($stock->id);
                    $deducted = $res->quantity - $currentQuantity;
                    $res->quantity = $deducted;
                    $res->save();
                    break;
                } else if ($stock->quantity == $currentQuantity) {
                    $res = Stock::find($stock->id);
                    $res->quantity = 0;
                    $res->save();
                    break;
                } else if ($stock->quantity < $currentQuantity) {
                    $res = Stock::find($stock->id);
                    $currentQuantity =  $currentQuantity - $res->quantity;
                    $res->quantity = 0;
                    $res->save();
                }
            }


            $sale->save();
        }

        return $stocks;
    }
}
