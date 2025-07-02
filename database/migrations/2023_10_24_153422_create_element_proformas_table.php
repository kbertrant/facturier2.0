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
        Schema::create('element_proformas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_prod')->nullable();
            $table->unsignedBigInteger('id_pro')->nullable();
            $table->integer('ep_qty')->nullable();
            $table->integer('ep_pu')->nullable();
            $table->integer('ep_ttc')->nullable();
            $table->string('ep_lib')->nullable();
            $table->integer('ep_mht')->nullable();
            $table->integer('ep_tva')->nullable();
            $table->string('ep_stat')->default('Pending');
            $table->timestamps();

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
        Schema::dropIfExists('element_proformas');
    }
};
