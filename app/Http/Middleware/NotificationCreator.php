<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use App\Models\Stock;
use Closure;
use Illuminate\Http\Request;

class NotificationCreator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $out = Stock::outOfStock()->get()->all();
        $low = Stock::lowOnStock()->get()->all();
        $soon = Stock::soonToExpire()->get()->all();

        if (count($out) > 0) {
            $message = "";

            if (count($out) > 1) {
                $message = strval(count($out)) . " items are out of stock";
            } else {
                $message = strval(count($out)) . " item is out of stock";
            }
            $scope = Notification::hour($message)->get()->all();
            if (count($scope) < 1) {
                $notification = Notification::create([
                    "user_id" => auth()->user()->id,
                    "message" => $message,
                    "type" => "out"
                ]);
                $notification->save();
            }
        }

        if (count($low) > 0) {
            $message = "";

            if (count($low) > 1) {
                $message = strval(count($low)) . " items are low of stock";
            } else {
                $message = strval(count($low)) . " item is low of stock";
            }
            $scope = Notification::hour($message)->get()->all();
            if (count($scope) < 1) {
                $notification = Notification::create([
                    "user_id" => auth()->user()->id,
                    "message" => $message,
                    "type" => "low"
                ]);
                $notification->save();
            }
        }

        if (count($soon) > 0) {
            $message = "";

            if (count($soon) > 1) {
                $message = strval(count($soon)) . " items are soon to be expired";
            } else {
                $message = strval(count($soon)) . " item is soon to be expired";
            }
            $scope = Notification::hour($message)->get()->all();
            if (count($scope) < 1) {
                $notification = Notification::create([
                    "user_id" => auth()->user()->id,
                    "message" => $message,
                    "type" => "soon"
                ]);
                $notification->save();
            }
        }

        return $next($request);
    }
}
