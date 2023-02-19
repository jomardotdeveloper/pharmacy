<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "measurement",
        "variant",
        "description",
        "cost_per_pc",
        "cost_per_half",
        "cost_per_bundle",
        "quantity_per_half",
        "quantity_per_bundle",
        "category_id",
        "srp",
        "medicine_type",
        "seasonal",
    ];


    public function reorderings(){
        return $this->hasMany(Reordering::class, "product_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, "product_id");
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, "product_id");
    }

    public function getItemStocksAttribute()
    {
        $count = 0;
        foreach ($this->stocks->all() as $stock) {
            if (!$stock->is_expired) {
                $count = $count + $stock->quantity;
            }
        }
        return $count;
    }

    public function getSalesMonthAttribute()
    {
        if ($this->sales) {
            // foreach()
        }
    }

    public function getTotalSalesAttribute()
    {
        $count = 0;
        foreach ($this->sales as $sale) {
            $count = $count + $sale->total_cost;
        }
        return $count;
    }

    public function getFullNameAttribute()
    {
        if ($this->variant) {
            return "$this->name ($this->variant)";
        }
        return $this->name;
    }

    
}
