<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 255);
            $table->text('description');
            $table->smallInteger('published');
            $table->smallInteger('time');
            $table->tinyInteger('age_limit');
            $table->string('poster', 255)->default(asset('images/no-poster.jpg'));
            $table->boolean('new_movie');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
