<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('lf_num')->unique();
            $table->date('lf_date')->nullable();
            $table->integer('lf_qte')->nullable();
            $table->string('lf_stat')->default('A');
            $table->string('status');
            $table->unsignedBigInteger('id_four');
            $table->unsignedBigInteger('id_prod');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->timestamps();
            $table->foreign('id_four')->references('id')->on('fournisseurs');
            $table->foreign('id_prod')->references('id')->on('produits');
            $table->foreign('id_ent')->references('id')->on('entreprises');
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
        Schema::dropIfExists('livraisons');
    }
}
