<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDastosEmpresasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dastos_empresas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('barra')->nullable();
            $table->string('codigo')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->string('telefono')->nullable();
            $table->string('name_cliente')->nullable();
            $table->string('comentario')->nullable();
            $table->string('fecha_entregado')->nullable();
            $table->string('fecha_recibido')->nullable();
            $table->string('monto')->nullable();
            $table->string('direccion')->nullable();
            $table->string('comentario_ciudad')->nullable();
            $table->integer('observaciones_id')->unsigned()->index();
            $table->foreign('observaciones_id')->references('id')->on('observaciones')->onDelete('no action');
            $table->integer('historials_id')->unsigned()->index();
            $table->foreign('historials_id')->references('id')->on('historials')->onDelete('no action');
            $table->integer('empleados_id')->unsigned()->index();
            $table->foreign('empleados_id')->references('id')->on('empleados')->onDelete('no action');
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
        Schema::drop('dastos_empresas');
    }

}
