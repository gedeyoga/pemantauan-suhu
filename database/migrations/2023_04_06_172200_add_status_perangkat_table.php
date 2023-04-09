<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perangkats', function (Blueprint $table) {
            $table->enum('status' , ['active' , 'not-active'])->default('not-active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perangkats', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
