<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
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

    public function getIsExpiredAttribute()
    {
        if ($this->expiration_date)
            return new DateTime($this->expiration_date) <= new DateTime();
        else
            return false;
    }

    public function scopeItem($query, $id)
    {
        return $query->where("product_id", $id);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where("quantity", "<=", 0);
    }

    public function scopeLowOnStock($query)
    {
        return $query->where("quantity", "<=", 5)->where("quantity", ">", 0);
    }

    public function scopeNotExpired($query)
    {
        return $query->whereDate("expiration_date", ">", date("Y-m-d"))->orWhere("expiration_date", "=", null);
    }

    public function scopeSoonToExpire($query)
    {
        $date = date('Y-m-d', strtotime('+5 days'));
        return $query->whereDate("expiration_date", "<=", $date);
    }
}
