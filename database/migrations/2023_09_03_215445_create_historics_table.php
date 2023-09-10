<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usr');
            $table->string('lib_histo')->default('Activities done by user connected');
            $table->datetime('date_histo')->nullable();
            $table->unsignedBigInteger('id_ent');
            $table->timestamps();
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
        Schema::dropIfExists('historics');
    }
}
