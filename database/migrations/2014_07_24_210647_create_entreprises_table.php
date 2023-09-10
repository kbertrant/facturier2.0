<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('name_ent')->unique();
            $table->string('rc_ent')->unique();
            $table->string('nc_ent')->unique();
            $table->string('phone_ent');
            $table->string('address_ent');
            $table->string('owner_ent');
            $table->string('bank_ent');
            $table->string('logo_ent');
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
        Schema::dropIfExists('entreprises');
    }
}
