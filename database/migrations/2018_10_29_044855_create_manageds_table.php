<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managed', function (Blueprint $table) {
            $table->integer('adminID')->unsigned();
            $table->integer('userID')->unsigned();
            $table->foreign('adminID')->references('id')->on('users');
            $table->foreign('userID')->references('id')->on('users');
            $table->string('changeType');
            $table->timestamp('timestamp');
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
        Schema::dropIfExists('managed');
    }
}
