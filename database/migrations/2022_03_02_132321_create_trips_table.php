<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedDecimal('distance')->default(0);
            $table->dateTime('date');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('car_id');

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('car_id')->references('id')->on('cars')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
