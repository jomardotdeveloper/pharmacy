<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleParent extends Model
{
    use HasFactory;

    protected $fillable = [
        "payment",
        "change",
        "user_id",
        "discount",
        "tax",
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, "parent_id");
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->sales as $sale) {
            $total += $sale->total_cost;
        }

        return $total;
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function scopeToday($query)
    {
        return $query->whereDate("created_at", date("Y-m-d"));
    }

    public function scopeMonth($query)
    {
        $query->whereMonth("sale_date", Carbon::now()->month);
    }

    public function getFormattedNumberAttribute()
    {
        $id = strval($this->id);
        return "S" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getTotalWithVatDiscountAttribute()
    {
        $discountPercentage = $this->discount / 100;
        $taxPercentage = $this->tax / 100;
        $taxAmount = $this->total * $taxPercentage;
        $discountAmount = $this->total * $discountPercentage;

        return($this->total + $taxAmount) - $discountAmount;
    }
}
