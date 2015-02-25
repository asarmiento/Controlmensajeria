<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistorialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('historials', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mes');
            $table->string('year');
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
        Schema::drop('historials');
    }

}
