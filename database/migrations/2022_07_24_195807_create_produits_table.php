<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('code_prod')->unique();
            $table->string('name_prod');
            $table->string('desc_prod');
            $table->decimal('price_prod');
            $table->integer('qty_prod');
            $table->string('color_prod')->nullable();
            $table->integer('size_prod')->nullable();
            $table->string('volume')->nullable();
            $table->string('poids')->nullable();
            $table->string('detail')->default('N');
            $table->string('neuf')->default('Y');
            $table->string('is_stock')->default('N');
            $table->string('status')->default('A');
            $table->string('img')->default('product.png');
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->unsignedBigInteger('id_ent')->nullable();
            $table->timestamps();

            $table->foreign('id_cat')->references('id')->on('cat_produits');
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
        Schema::dropIfExists('produits');
    }
}
