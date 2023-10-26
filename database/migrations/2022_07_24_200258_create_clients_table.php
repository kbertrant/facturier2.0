<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('name_cli');
            $table->string('rs_cli')->nullable();
            $table->string('phone_cli');
            $table->string('address_cli')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('cl_rccm')->nullable();
            $table->string('cl_nui')->nullable();
            $table->string('cl_email')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_tc')->nullable();
            $table->timestamps();

            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_tc')->references('id')->on('type_clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
