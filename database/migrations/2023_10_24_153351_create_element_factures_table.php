<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_factures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_prod')->nullable();
            $table->unsignedBigInteger('id_fac')->nullable();
            $table->integer('ef_qty')->nullable();
            $table->integer('ef_pu')->nullable();
            $table->integer('ef_mht')->nullable();
            $table->string('ef_lib')->nullable();
            $table->integer('ef_ttc')->nullable();
            $table->integer('ef_tva')->nullable();
            $table->string('ef_stat')->default('Pending');
            $table->timestamps();

            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_fac')->references('id')->on('factures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element_factures');
    }
};
