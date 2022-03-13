<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiversTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('population_assesment_id')->unsigned();
            $table->string('total_value');
            $table->integer('wave_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('population_assesment_id')->references('id')->on('population_assesments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wave_id')->references('id')->on('waves')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receivers');
    }
}
