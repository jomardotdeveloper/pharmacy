<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        "parent_id",
        "product_id",
        "quantity",
        "unit",
        "total_cost",
        "cost"
    ];


    public function parent()
    {
        return $this->belongsTo(SaleParent::class, "parent_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function scopeParent($query, $id)
    {
        return $query->where("parent_id", $id);
    }

    public function scopeItem($query, $product_id)
    {
        return $query->where("product_id", $product_id);
    }

    public function scopeMonth($query)
    {
        return $query->whereRaw("MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
    }

    public function scopeDateGiven($query, $day, $month)
    {
        return $query->whereRaw("MONTH(created_at) = ? AND YEAR(created_at) = YEAR(CURDATE()) AND DAY(created_at) = ?", [$month, $day]);
    }
}
