<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnMemberCertification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_certification', function (Blueprint $table){
            $table->unsignedInteger('assessor_id')->nullable();
            $table->boolean('approve_assessor')->default(false)->comment('Apakah Penetapan Asesor sudah diapprove : true jika sudah diapprove');
            $table->dateTime('date_approved_assessor')->nullable()->comment('Tanggal Penetapan Asesor diapprove');
            $table->unsignedInteger('approved_assessor_by')->nullable()->comment('Penetapan Asesor diapprove oleh ?');

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
        Schema::table('member_certification', function (Blueprint $table) {
            $table->dropColumn('assessor_id');
            $table->dropColumn('approve_assessor');
            $table->dropColumn('date_approved_assessor');
            $table->dropColumn('approved_assessor_by');

            $table->dropForeign('assessor_id');
        });
    }
}
