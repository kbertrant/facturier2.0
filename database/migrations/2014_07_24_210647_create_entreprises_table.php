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
            $table->string('nc_ent')->unique()->nullable();
            $table->string('phone_ent')->nullable();
            $table->string('address_ent')->nullable();
            $table->string('owner_ent')->nullable();
            $table->string('bank_ent')->nullable();
            $table->string('logo_ent')->nullable();
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
