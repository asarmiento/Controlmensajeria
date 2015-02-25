<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmpleadosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empleados', function(Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('sname');
            $table->string('flast');
            $table->string('slast');
            $table->string('cedula');
            $table->string('celular');
            $table->integer('ciudades_id')->unsigned()->index();
            $table->foreign('ciudades_id')->references('id')->on('ciudades')->onDelete('no action');
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
        Schema::drop('empleados');
    }

}
