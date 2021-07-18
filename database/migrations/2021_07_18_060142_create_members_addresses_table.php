<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id")->constrained("members");
            $table->string('name_en',20);
            $table->string('name_mm',20);
            $table->text('address_en')->nullable();
            $table->text('address_mm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members_addresses');
    }
}
