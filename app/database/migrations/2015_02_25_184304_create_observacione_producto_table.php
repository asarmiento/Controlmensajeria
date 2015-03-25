<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObservacioneProductoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('observacione_producto', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('observaciones_id')->unsigned()->index();
            $table->foreign('observaciones_id')->references('id')->on('observaciones')->onDelete('no action');
            $table->integer('productos_id')->unsigned()->index();
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('observacione_producto');
    }

}
