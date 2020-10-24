<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('screening_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->boolean('payment_status');
            $table->float('price', 8, 2);
            $table->smallInteger('tickets_number');
        });
        
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('screening_id')
                ->references('id')
                ->on('screenings')
                ->onDelete('set null');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
