<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObservacionesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('observaciones', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('estados_id')->unsigned()->index();
            $table->foreign('estados_id')->references('id')->on('estados')->onDelete('no action');
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
        Schema::drop('observaciones');
    }

}
