<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('productos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('empresas_id')->unsigned()->index();
            $table->foreign('empresas_id')->references('id')->on('empresas')->onDelete('no action');
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
        Schema::drop('productos');
    }

}
