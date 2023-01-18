<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            "conradiance", "BCFE", "task force marketing",
            "midland dist. corp", "ajinomoto", "actiserve",
            "fros marketing", "bpci", "maxi plus", "task force",
            "liwayway", "nutri snacks", "force central", "wellmaid",
            "right price marketing", "jr&r", "FGL", "maxi plus", "rebisco",
            "lemonsquare", "pmfpc", "14m", "RSS Lando",
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                "name" => $supplier
            ]);
        }
    }
}
