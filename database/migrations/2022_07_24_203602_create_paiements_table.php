<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cli');
            $table->unsignedBigInteger('id_exe')->nullable();
            $table->unsignedBigInteger('id_fac')->nullable();
            $table->unsignedBigInteger('id_usr')->nullable();
            $table->string('ref_pay')->unique();
            $table->datetime('date_pay');
            $table->decimal('mttc_pay');
            $table->decimal('mht_pay');
            $table->decimal('tva_pay');
            $table->integer('solde_pay');
            $table->string('mode_pay');
            $table->string('status');
            $table->string('stat_pay');
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->timestamps();

            $table->foreign('id_cli')->references('id')->on('clientes');
            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_fac')->references('id')->on('factures');
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
        Schema::dropIfExists('paiements');
    }
}
