<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('food_id')->unsigned();
            // $table->unsignedBigInteger('rest_city_id')->unsigned();
            $table->string('title',100);
            $table->string('city',100)->nullable();
            $table->text('addres',500)->nullable();
            $table->string('photo',500)->nullable();
            $table->time('open')->nullable();
            $table->time('close')->nullable();
            $table->string('phone',500)->nullable();
            $table->text('des',500)->nullable();
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
        Schema::dropIfExists('restaurants');
    }
};