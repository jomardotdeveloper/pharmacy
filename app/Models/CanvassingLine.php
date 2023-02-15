<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvassingLine extends Model
{
    use HasFactory;

    protected $fillable = [
        "parent_id",
        "product_id",
        "expiration_date",
        "quantity",
        "cost",
        "total_cost"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function parent()
    {
        return $this->belongsTo(Canvassing::class, "parent_id");
    }
}
