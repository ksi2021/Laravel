<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaitsTable extends Migration
{
    public function up()
    {
        Schema::create('raits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('prod_id')->unsigned();
            $table->foreign('prod_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('rait');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('raits');
    }
}
