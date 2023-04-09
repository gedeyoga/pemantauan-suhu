<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatuanSuhuPerangkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perangkats', function (Blueprint $table) {
            $table->string('satuan_suhu')->after('name');
            $table->string('suhu')->after('name');
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
            $table->dropColumn(['suhu' , 'satuan_suhu']);
        });
    }
}
