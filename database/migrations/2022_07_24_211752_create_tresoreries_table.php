<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTresoreriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tresoreries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_exe')->nullable();
            $table->integer('amount');
            $table->integer('amount_tres');
            $table->dateTime('date_tres');
            $table->string('mouvement');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_shop')->nullable();
            $table->unsignedInteger('id_cur');
            $table->timestamps();

            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_shop')->references('id')->on('shops');
            $table->foreign('id_cur')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tresoreries');
    }
}
