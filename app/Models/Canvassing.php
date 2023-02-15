<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canvassing extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "supplier_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }

    public function lines()
    {
        return $this->hasMany(CanvassingLine::class, "parent_id");
    }

    public function getFormattedNumberAttribute()
    {
        $id = strval($this->id);
        return "CV" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->lines as $line) {
            $total += $line->total_cost;
        }

        return $total;
    }
}
