<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->set('place', [
                'homepage_slider',
                'homepage_top',
                'homepage_bottom',
                'repertoire',
                'pricing',
                'about_side',
                'about_bottom',
                'api',
            ])->unique();
            $table->text('content')->nullable();
            $table->smallInteger('max_length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
}
