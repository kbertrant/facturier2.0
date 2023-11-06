<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemboursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remboursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cli');
            $table->unsignedBigInteger('id_fac')->nullable();
            $table->unsignedBigInteger('id_pay')->nullable();
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->datetime('date_remb');
            $table->string('ref_remb')->unique();
            $table->integer('amount_remb');
            $table->string('mode_remb');
            $table->string('status');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->timestamps();

            $table->foreign('id_cli')->references('id')->on('clientes');
            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_fac')->references('id')->on('factures');
            $table->foreign('id_pay')->references('id')->on('paiements');
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
        Schema::dropIfExists('remboursements');
    }
}
