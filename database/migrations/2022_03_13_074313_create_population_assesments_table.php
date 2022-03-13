<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationAssesmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_assesments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_criteria_id')->unsigned();
            $table->integer('population_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sub_criteria_id')->references('id')->on('sub_criterias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('population_id')->references('id')->on('populations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('population_assesments');
    }
}
