<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->string('town_pcode',12);
            $table->string('sr_pcode',6);
            $table->string('name_en',35);
            $table->string('name_mm',35);
            $table->primary('town_pcode');
            $table->foreign("sr_pcode")->references("sr_pcode")->on("state_regions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('towns');
    }
}
