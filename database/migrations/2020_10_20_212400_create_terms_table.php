<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('screening_id')->unsigned();
            $table->bigInteger('hall_id')->unsigned()->nullable();
            $table->bigInteger('pricing_id')->unsigned()->nullable();
            $table->timestamps();
            $table->dateTime('date_time', 0);
        });
        
        Schema::table('terms', function (Blueprint $table) {
            $table->foreign('screening_id')
                ->references('id')
                ->on('screenings')
                ->onDelete('cascade');
            
            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete('set null');
                
            $table->foreign('pricing_id')
                ->references('id')
                ->on('pricings')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
