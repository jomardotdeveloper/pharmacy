<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_parents', function (Blueprint $table) {
            $table->id();
            $table->timestamp("purchase_date")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->foreignId("user_id")->nullable()->constrained("users")->onDelete("cascade");
            $table->foreignId("supplier_id")->nullable()->constrained("suppliers")->onDelete("cascade");
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
        Schema::dropIfExists('purchase_parents');
    }
}
