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
            $table->id();
            $table->unsignedBigInteger('population_id')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->boolean('is_process')->default(false);
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
        Schema::dropIfExists('population_assesments');
    }
}
