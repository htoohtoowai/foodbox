<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('username',20);
            $table->string('name');
            $table->tinyInteger('level')->default(1);
            $table->string('town_pcode',12);
            $table->string('password');
            $table->boolean('is_verified')->default(false);
            $table->foreign("town_pcode")->references("town_pcode")->on("towns");
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
        Schema::dropIfExists('members');
    }
}
