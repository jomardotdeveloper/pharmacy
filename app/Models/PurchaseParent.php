<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseParent extends Model
{
    use HasFactory;

    protected $fillable = [
        "purchase_date",
        "user_id",
        "supplier_id",
        
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, "parent_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }

    public function getFormattedNumberAttribute()
    {
        $id = strval($this->id);
        return "P" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->purchases as $purchase) {
            $total += $purchase->total_cost;
        }

        return $total;
    }
    

    
}
