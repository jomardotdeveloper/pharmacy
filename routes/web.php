<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UserController;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTHENTICATION ROUTES
Route::get("/",  [LoginController::class, "login"])->name("login.login")->middleware("checkauth");
Route::get("/login",  [LoginController::class, "login"])->name("login.login")->middleware("checkauth");
Route::post("/login/authenticate",  [LoginController::class, "authenticate"])->name("login.authenticate");
Route::post("/logout", function (Request $request) {
    Log::create([
        "user_id" => auth()->user()->id,
        "action" => "logout"
    ]);
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route("login.login");
})->name("logout");

Route::get("/dashboard", [DashboardController::class, "dashboard"])->middleware(["auth", "notification"])->name("dashboards.dashboard");
Route::get("/dashboard/data/{daysInMonth}/{month}", [DashboardController::class, "getGraphData"])->middleware(["auth"])->name("dashboards.dashboard.data");
Route::resource("suppliers", SupplierController::class)->middleware(["auth", "notification"]);
Route::resource("categories", CategoryController::class)->middleware(["auth", "notification"]);
Route::resource("products", ProductController::class)->middleware(["auth", "notification"]);
Route::resource("stocks", StockController::class)->middleware(["auth", "notification"]);
Route::resource("users", UserController::class)->middleware(["auth", "notification"]);
Route::resource("procurements", ProcurementController::class)->middleware(["auth", "notification"]);
Route::resource("discounts", DiscountController::class)->middleware(["auth", "notification"]);
Route::resource("taxes", TaxController::class)->middleware(["auth", "notification"]);
Route::get("/logs",[ LogController::class, "index"])->middleware(["auth", "notification"])->name("logs.index");
Route::get("/settings",[ SettingController::class, "index"])->middleware(["auth", "notification"])->name("settings.index");
Route::post("/settings/update",[ SettingController::class, "update"])->middleware(["auth", "notification"])->name("settings.update");
Route::get("/users/reset_password/{id}", [UserController::class, "resetPassword"])->middleware("auth")->name("users.reset_password");
Route::get("/users/remove_first_time/{id}", [UserController::class, "removeFirstTime"])->middleware("auth")->name("users.remove_first_time");

//SALES ROUTES
Route::get("/sale", [SaleController::class, "sale"])->middleware(["auth", "notification"])->name("sales.sale");
Route::get("/sale/show/{id}", [SaleController::class, "show"])->middleware(["auth", "notification"])->name("sales.sale.show");

//OUT ROUTES
Route::get("/out", [OutController::class, "out"])->middleware(["auth", "notification"])->name("outs.out");
Route::get("/out/show/{id}", [OutController::class, "show"])->middleware(["auth", "notification"])->name("outs.out.show");

//SHOP ROUTES
Route::get("/shop", [ShopController::class, "shop"])->middleware(["auth", "notification"])->name("shops.shop");
Route::get("/shop/products/", [ShopController::class, "getAvailableProducts"])->middleware("auth")->name("shops.shop.products");
Route::post("/shop/checkout/", [ShopController::class, "checkout"])->middleware("auth")->name("shops.shop.checkout");
