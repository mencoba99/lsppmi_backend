<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnProgramSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->tinyInteger('registration_closed')->default(0)->comment('0=Open Registration , 1 = Closed Registration');
            $table->dateTime('date_registration_closed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->dropColumn('registration_closed');
            $table->dropColumn('date_registration_closed');
        });
    }
}
