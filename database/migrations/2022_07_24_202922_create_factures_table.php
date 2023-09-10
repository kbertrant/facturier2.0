<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cli');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_pro')->nullable();
            $table->datetime('date_fac');
            $table->string('ref_fac')->unique();
            $table->integer('amount_fac');
            $table->integer('qty_fac');
            $table->integer('tva_price');
            $table->integer('reduction');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_cli')->references('id')->on('clientes');
            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_pro')->references('id')->on('proformas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
