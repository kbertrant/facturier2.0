<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_exe')->nullable();
            $table->unsignedBigInteger('id_four')->nullable();
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->string('ref_dep')->unique();
            $table->string('label_dep');
            $table->datetime('date_dep');
            $table->integer('amount_dep');
            $table->integer('solde_dep');
            $table->string('mode_dep');
            $table->string('status');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->timestamps();
            
            $table->foreign('id_usr')->references('id')->on('users');
            $table->foreign('id_four')->references('id')->on('fournisseurs');
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
        Schema::dropIfExists('depenses');
    }
}
