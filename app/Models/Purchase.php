<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "parent_id",
        "product_id",
        "quantity",
        "cost",
        "total_cost",
        "stock_id",
    ];

    public function parent()
    {
        return $this->belongsTo(PurchaseParent::class, "parent_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    
    public function stock()
    {
        return $this->belongsTo(Out::class, "stock_id");
    }
}
