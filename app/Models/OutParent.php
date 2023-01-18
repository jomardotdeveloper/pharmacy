<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutParent extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function outs()
    {
        return $this->hasMany(Out::class, "parent_id");
    }

    public function getFormattedNumberAttribute()
    {
        $id = strval($this->id);
        return "P" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }
}
