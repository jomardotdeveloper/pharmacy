<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_parents', function (Blueprint $table) {
            $table->id();
            $table->timestamp("sale_date")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->float("payment");
            $table->float("change");
            $table->integer("discount")->nullable();
            $table->integer("tax")->nullable();
            $table->foreignId("user_id")->nullable()->constrained("users")->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_parents');
    }
}
