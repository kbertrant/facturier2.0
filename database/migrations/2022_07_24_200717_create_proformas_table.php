<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cli');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->datetime('date_pro');
            $table->string('pro_ref')->unique();
            $table->integer('mttc_pro');
            $table->integer('qty_pro');
            $table->integer('tva_pro');
            $table->integer('reduction');
            $table->decimal('mht_pro');
            $table->integer('rs_pro')->default(0);
            $table->string('status');
            $table->string('stat_pro');
            $table->timestamps();

            $table->foreign('id_cli')->references('id')->on('clientes');
            $table->foreign('id_usr')->references('id')->on('users');
            $table->foreign('id_ent')->references('id')->on('entreprises');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proformas');
    }
}
