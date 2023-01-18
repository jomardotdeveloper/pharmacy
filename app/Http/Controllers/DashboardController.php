<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleParent;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $this->getGraphData(31, 1);
        // dd(Sale::max("product_id"));
        return view("admin.dashboard.dashboard", [
            "products" => Product::all(),
            "sales" => SaleParent::today()->get()->all(),
            "out" => Stock::outOfStock()->get()->all(),
            "low" => Stock::lowOnStock()->get()->all(),
            "soon" => Stock::soonToExpire()->get()->all(),
            "product" => $this->getProductOfTheMonth()
        ]);
    }

    public function getGraphData($daysInMonth, $month)
    {
        $data = [];
        $days = [];
        $revenue = 0;

        for ($i = 0; $i < intval($daysInMonth); $i++) {
            array_push($days, $i + 1);
        }

        foreach ($days as $day) {
            $sales = Sale::dateGiven($day, $month)->get()->all();

            foreach ($sales as $sale) {
                $revenue += $sale->total_cost;
            }

            $data[$day]  = count($sales);
        }
        $data["revenue"] = $revenue;
        return $data;
    }

    public function getProductOfTheMonth()
    {
        $products = Product::all();
        $product = null;

        foreach ($products as $chosen) {
            $sales = Sale::item($chosen->id)->month()->get()->all();
            if (count($sales) < 1) {
                continue;
            }

            if ($product) {
                $currentSale = Sale::item($product->id)->month()->get()->all();
                if (count($currentSale) < count($sales)) {
                    $product = $chosen;
                }
            } else {
                $product = $chosen;
            }
        }

        return $product;
    }
}
