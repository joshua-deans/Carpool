<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpools', function (Blueprint $table) {
            $table->increments('rideId');
            $table->integer('driverID')->unsigned();
            $table->integer('passID')->unsigned();
            $table->foreign('driverID')->references('id')->on('users');
            $table->foreign('passID')->references('id')->on('users');
            $table->dateTime('carpoolDateTime');
            $table->integer('peopleCap');
            $table->integer('peopleCur');
            $table->text('coords');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carpools');
    }
}
