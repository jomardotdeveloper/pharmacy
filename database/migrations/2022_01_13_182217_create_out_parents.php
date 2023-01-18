<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutParents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_parents', function (Blueprint $table) {
            $table->id();
            $table->timestamp("out_date")->default(DB::raw("CURRENT_TIMESTAMP"));
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
        Schema::dropIfExists('out_parents');
    }
}
