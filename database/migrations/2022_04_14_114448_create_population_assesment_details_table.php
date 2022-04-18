<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationAssesmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('population_assesment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('population_assesment_id')->nullable();
            $table->unsignedBigInteger('sub_criteria_id')->nullable();
            $table->integer('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('population_assesment_details');
    }
}
