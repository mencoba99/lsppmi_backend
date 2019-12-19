<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnAssessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessors', function (Blueprint $table) {
            $table->string('no_reg')->nullable();
            $table->date('license_date')->nullable();
        });

        Schema::table('competence_places', function (Blueprint $table) {
            $table->string('pic')->nullable()->comment('Penanggung Jawab TUK');
            $table->integer('capacity')->nullable()->comment('Kapasitas Peserta TUK');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessors', function (Blueprint $table) {
            $table->dropColumn('no_reg');
            $table->dropColumn('license_date');
        });

        Schema::table('competence_places', function (Blueprint $table) {
            $table->dropColumn('pic');
            $table->dropColumn('capacity');
        });
    }
}
