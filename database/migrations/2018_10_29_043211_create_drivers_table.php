<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->integer('id')->unsigned();;
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->string('licenseStatus');
            $table->binary('carPic')->nullable();
            $table->string('carModel');
            $table->integer('carCapacity')->unsigned();
//            driver(userID: integer, licenseStatus:varchar(15), carPic: blob, carModel: varchar(15), carCapacity: integer(1-8?))

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
        Schema::dropIfExists('drivers');
    }
}
