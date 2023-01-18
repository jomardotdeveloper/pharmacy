<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    use HasFactory;

    protected $fillable = [
        "parent_id",
        "product_id",
        "expiration_date",
        "quantity",
        "supplier_id"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }

    public function parent()
    {
        return $this->belongsTo(OutParent::class, "parent_id");
    }
}
