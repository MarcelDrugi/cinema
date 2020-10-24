<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreeningsTable extends Migration
{
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movie_id')->unsigned();
            $table->timestamps();
            $table->smallInteger('viewers');
        });
        
        Schema::table('screenings', function (Blueprint $table) {
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('screenings');
    }
}
