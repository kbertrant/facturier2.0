<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_produits', function (Blueprint $table) {
            $table->id();
            $table->string('cat_name');
            $table->string('cat_stat')->default('A');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('cat_produits');
    }
}
