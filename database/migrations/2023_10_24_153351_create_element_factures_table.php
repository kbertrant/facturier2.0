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
            $table->decimal('ef_pu')->nullable();
            $table->decimal('ef_mht')->nullable();
            $table->decimal('ef_ttc')->nullable();
            $table->decimal('ef_tva')->nullable();
            $table->string('ef_stat')->default('Pending');
            $table->timestamps();

            $table->foreign('id_ent')->references('id')->on('entreprises');
            $table->foreign('id_prod')->references('id')->on('produits');
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
