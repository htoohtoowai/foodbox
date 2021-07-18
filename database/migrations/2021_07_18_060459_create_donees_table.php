<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("category_items_id")->constrained("category_items");
            $table->foreignId("member_id")->constrained("members");
            $table->integer('qty');
            $table->string('unit')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('donees');
    }
}
