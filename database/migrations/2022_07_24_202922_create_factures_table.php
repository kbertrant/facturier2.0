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
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->datetime('date_fac');
            $table->string('ref_fac')->unique();
            $table->decimal('mht_fac');
            $table->decimal('mttc_fac');
            $table->integer('qty_fac');
            $table->integer('tva_fac');
            $table->integer('rs_fac');
            $table->decimal('reduction');
            $table->string('status')->default('A');
            $table->string('stat_fac');
            $table->timestamps();

            $table->foreign('id_cli')->references('id')->on('clientes');
            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_pro')->references('id')->on('proformas');
            $table->foreign('id_usr')->references('id')->on('users');
            
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
