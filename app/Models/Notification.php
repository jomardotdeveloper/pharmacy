<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "message",
        "type"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function getTimeAttribute()
    {
        $to_time = strtotime($this->sent_datetime);
        $from_time = strtotime(date("Y-m-d H:i:s"));

        $mins = round(intval(abs($to_time - $from_time) / 60, 2)) . " mins ago";

        if($mins < 60) {
            return $mins . " mins ago";
        }else{
            return round(intval(abs($to_time - $from_time) / 60 / 60, 2)) . " hours ago";
        }
        return round(intval(abs($to_time - $from_time) / 60, 2)) . " mins ago";
    }

    public function scopeHour($query, $message)
    {
        $query->whereRaw("HOUR(sent_datetime) = ? AND DATE(sent_datetime) = CURDATE() AND message = ?", [
            date("H"),
            $message
        ]);
    }
}
