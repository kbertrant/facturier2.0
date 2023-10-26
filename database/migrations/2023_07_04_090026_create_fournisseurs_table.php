<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('four_name')->unique();
            $table->string('four_code')->nullable();
            $table->string('four_adress')->nullable();
            $table->string('four_phone')->nullable();
            $table->string('four_stat')->default('A');
            $table->string('resp_name')->nullable();
            $table->string('four_rccm')->nullable();
            $table->string('four_nui')->nullable();
            $table->string('four_email')->nullable();
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
        Schema::dropIfExists('fournisseurs');
    }
}
