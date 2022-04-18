<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopulationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('populations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('card_id_number', 255)->unique();
            $table->string('family_card_id', 255);
            $table->string('name');
            $table->string('phone_number');
            $table->string('gender');
            $table->date('birth_date');
            $table->text('address');
            $table->biginteger('village_id')->unsigned();
            $table->string('zip_code');
            $table->biginteger('created_by')->unsigned();
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
        Schema::drop('populations');
    }
}
