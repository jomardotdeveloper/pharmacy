<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $categories = [
        //     "bath and body care",
        //     "powder detergent",
        //     "Bleach and Fabric Conditioners",
        //     "Bar and liquid Detergent",
        //     "Hair care",
        //     "Seasonings and mixes",
        //     "Noodles",
        //     "Coffee",
        //     "Ready to Drink",
        //     "Chips",
        //     "Powdered Drink",
        //     "Spreads and Dressings",
        //     "Milk",
        //     "Condiments and Spices",
        //     "Canned Meat",
        //     "Canned Seafood",
        //     "Oil and Sauces",
        //     "Packed Fruits",
        //     "Cleaning Product",
        //     "Feminine Care",
        //     "Diapers",
        //     "Candies and Chocolates",
        //     "Oral Care",
        //     "Bread and Biscuits",
        //     "Cigarettes",
        //     "Alcohol",
        //     "Softdrinks"
        // ];


        $categories = [
            "Analgesic/Antipyretic(Fever)",
            "Cold Medicines",
            "Anti-inflamatorry",
            "Anti-allergy",
            "Anti-inflamatorry",
            "Cough Medicine",
            "Anti hypertensive",
            "Antipyretic/Analgesic",
        ];


        $products = [
            array(
                "name" => "Paracetamol",
                "category_id" => 1,
                "cost_per_pc" => 5,
                "medicine_type" => "generic",
                "seasonal" => "11|02",
            ),
            array(
                "name" => "Symdex D tablet",
                "category_id" => 2,
                "cost_per_pc" => 3,
                "medicine_type" => "generic",
                "seasonal" => "11|02",
            ),
            array(
                "name" => "Diclofenac 50mg",
                "category_id" => 3,
                "cost_per_pc" => 1,
                "medicine_type" => "generic",
                "seasonal" => "11|02",
            ),
            array(
                "name" => "Losartan 50mg",
                "category_id" => 7,
                "cost_per_pc" => 2,
                "medicine_type" => "generic",
                "seasonal" => "03|05",
            ),

        ];

        foreach ($categories as $category) {
            Category::create([
                "name" => $category
            ]);
        }

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
