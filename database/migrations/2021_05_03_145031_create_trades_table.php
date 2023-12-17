<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner_card_id')->unsigned();
            $table->bigInteger('player_card_id')->unsigned();
            $table->string('status')->default("offered");
            $table->foreign('owner_card_id')->references('id')->on('user_cards');
            $table->foreign('player_card_id')->references('id')->on('user_cards');
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
        Schema::dropIfExists('trades');
    }
}
