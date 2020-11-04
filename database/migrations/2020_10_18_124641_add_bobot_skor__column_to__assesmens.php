<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBobotSkorColumnToAssesmens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assesmens', function (Blueprint $table) {
            $table->integer('bobot');
            $table->integer('skor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assesmens', function (Blueprint $table) {
            //
        });
    }
}
