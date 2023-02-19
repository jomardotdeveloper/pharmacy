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
        // dd($this->getTopSales()[0]);
        $this->getGraphData(31, 1);
        // dd(Sale::max("product_id"));
        // dd()

        $allProducts = Product::all();
        $seasonalProduct = null;
        foreach($allProducts as $product){
            $month = $product->seasonal ?  explode("|", $product->seasonal) : false;
            $currMonth = date("m");
            if($month){
                if(in_array($currMonth, $month)){
                    $seasonalProduct = $product;
                }
            }
                


        }


        // $seasonal = Product::where();
        return view("admin.dashboard.dashboard", [
            "products" => Product::all(),
            "sales" => SaleParent::today()->get()->all(),
            "out" => Stock::outOfStock()->get()->all(),
            "low" => Stock::lowOnStock()->get()->all(),
            "soon" => Stock::soonToExpire()->get()->all(),
            "product" => $this->getProductOfTheMonth(),
            "soon_30" => Stock::soonToExpire30()->get()->all(),
            "soon_90" => Stock::soonToExpire90()->get()->all(),
            "soon_180" => Stock::soonToExpire180()->get()->all(),
            "top_sales" => $this->getTopSales(),
            "seasonal" => $seasonalProduct,
            "soon_total" => count(Stock::soonToExpire30()->get()->all()) + count(Stock::soonToExpire90()->get()->all()) + count(Stock::soonToExpire180()->get()->all()) + count(Stock::soonToExpire()->get()->all()), 
        ]);
    }

    public function getTopSales(){
        $products = Product::all();
        $sales = Sale::all();
        $top = [];
        $top5 = [];


        foreach($products as $product){
            foreach($product->sales as $sale){
                if(!array_key_exists($product->id, $top)){
                    $top[$product->id] = 0;
                }
                $top[$product->id] += $sale->total_cost;
            }
        }

        arsort($top);
        // dd($products[0]->sales);
        foreach($top as $key => $value){
            $product = Product::find($key);

            array_push($top5, ["name" => $product->name, "total" => $value]);
        }
        return $top5;
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
