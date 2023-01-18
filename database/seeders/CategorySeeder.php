<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            "bath and body care",
            "powder detergent",
            "Bleach and Fabric Conditioners",
            "Bar and liquid Detergent",
            "Hair care",
            "Seasonings and mixes",
            "Noodles",
            "Coffee",
            "Ready to Drink",
            "Chips",
            "Powdered Drink",
            "Spreads and Dressings",
            "Milk",
            "Condiments and Spices",
            "Canned Meat",
            "Canned Seafood",
            "Oil and Sauces",
            "Packed Fruits",
            "Cleaning Product",
            "Feminine Care",
            "Diapers",
            "Candies and Chocolates",
            "Oral Care",
            "Bread and Biscuits",
            "Cigarettes",
            "Alcohol",
            "Softdrinks"
        ];

        foreach ($categories as $category) {
            Category::create([
                "name" => $category
            ]);
        }
    }
}
