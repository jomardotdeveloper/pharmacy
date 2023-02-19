<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("seasonal")->nullable();
            $table->float("srp")->nullable();
            $table->enum("medicine_type", ['generic', 'branded'])->default('generic');
            $table->string("measurement")->nullable();
            $table->string("variant")->nullable();
            $table->string("description")->nullable();
            $table->float("cost_per_pc")->nullable();
            $table->float("cost_per_half")->nullable();
            $table->float("cost_per_bundle")->nullable();
            $table->integer("quantity_per_half")->nullable();
            $table->integer("quantity_per_bundle")->nullable();
            $table->foreignId("category_id")->nullable()->constrained("categories")->onDelete("set null");
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
        Schema::dropIfExists('products');
    }
}
