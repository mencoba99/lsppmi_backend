<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnProgramSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->tinyInteger('is_approve')->default(0)->comment('0=Not Approved , 1 = Approved');
            $table->dateTime('date_approve')->nullable();
            $table->integer('approved_by')->nullable();
            $table->tinyInteger('is_publish')->default(0)->comment('0=Not Publish , 1 = Published');
            $table->dateTime('date_publish')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Open , 0 = Closed, 2 = Canceled');
            $table->dateTime('date_closed')->nullable();
            $table->integer('closed_by')->nullable();
            $table->text('remark')->nullable();
            $table->softDeletes();
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
            $table->dropColumn('is_approve');
            $table->dropColumn('date_approve');
            $table->dropColumn('approved_by');
            $table->dropColumn('is_publish');
            $table->dropColumn('date_publish');
            $table->dropColumn('status');
            $table->dropColumn('date_closed');
            $table->dropColumn('closed_by');
            $table->dropColumn('remark');
            $table->dropSoftDeletes();
        });
    }
}
