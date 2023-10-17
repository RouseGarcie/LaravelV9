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
        Schema::create('productoTraducciones', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement();
            $table->bigInteger('id_producto');
            $table->string('nombre');
            $table->string('descripcion_corta', 120);
            $table->string('descripcion_larga');
            $table->string('url');
            $table->string('idioma');
            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productoTraducciones');
    }
};
