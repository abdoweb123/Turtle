<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();

            $table->integer('client_id')->nullable();
            $table->integer('color_id')->nullable();

            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->nullable()->on('devices')->references('id')->onUpdate('cascade')->onDelete('cascade');

            $table->smallInteger('quantity');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
