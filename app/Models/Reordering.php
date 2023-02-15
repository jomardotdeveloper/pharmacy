<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reordering extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "quantity",
        "supplier_id",
        "min_quantity",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }
}
