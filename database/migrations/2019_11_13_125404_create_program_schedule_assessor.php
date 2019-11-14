<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramScheduleAssessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_schedule_assessor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('program_schedule_id')->nullable();
            $table->unsignedInteger('assessor_id')->nullable();
            $table->timestamps();

            $table->foreign('program_schedule_id')->references('id')->on('program_schedules');
            $table->foreign('assessor_id')->references('id')->on('assessors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_schedule_assessor');
    }
}
