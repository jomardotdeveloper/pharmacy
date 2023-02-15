<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getDaysLeftAttribute()
    {
        if ($this->expiration_date){
            return (new DateTime($this->expiration_date))->diff(new DateTime())->format("%a") + 1;
        }
            
        else
            return null;
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

    public function scopeSoonToExpire30($query)
    {
        $date = date('Y-m-d', strtotime('+30 days'));
        return $query->whereDate("expiration_date", "<=", $date);
    }

    public function scopeSoonToExpire90($query)
    {
        $date = date('Y-m-d', strtotime('+90 days'));
        $date_start = date('Y-m-d', strtotime('+30 days'));

        return $query->whereDate("expiration_date", "<=", $date)->whereDate("expiration_date", ">=", $date_start);
    }

    

    public function scopeSoonToExpire180($query)
    {
        $date = date('Y-m-d', strtotime('+180 days'));
        $date_start = date('Y-m-d', strtotime('+90 days'));

        return $query->whereDate("expiration_date", "<=", $date)->whereDate("expiration_date", ">=", $date_start);
    }
}
