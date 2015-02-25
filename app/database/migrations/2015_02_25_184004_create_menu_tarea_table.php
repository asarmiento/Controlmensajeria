<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuTareaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('menu_tarea', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('no action');
            $table->integer('tarea_id')->unsigned()->index();
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('menu_tarea');
    }

}
