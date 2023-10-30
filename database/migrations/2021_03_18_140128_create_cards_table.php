<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('collection_id')->constrained();        
            $table->string('name');
            $table->string('image')->nullable();
            $table->tinyInteger('rarity')->nullable();
            $table->integer('cost')->default(0);
            $table->string('status')->default("inactive");
            $table->string('top_filter')->default("none");
            $table->string('bottom_filter')->default("none");
            $table->text('text')->nullable();
            $table->string('layout')->default("vertical");
            
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
        Schema::dropIfExists('cards');
    }
}
