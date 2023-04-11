<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPerangkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_perangkats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perangkat_id');
            $table->double('suhu');
            $table->timestamps();

            $table->foreign('perangkat_id')->references('id')->on('perangkats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_perangkats');
    }
}
