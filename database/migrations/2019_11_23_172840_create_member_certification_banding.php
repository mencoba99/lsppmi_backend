<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCertificationBanding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_certification_banding', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_certification_id')->nullable();
            $table->unsignedInteger('member_id')->nullable();
            $table->boolean('q1')->nullable();
            $table->boolean('q2')->nullable();
            $table->boolean('q3')->nullable();
            $table->jsonb('competence_unit_id')->nullable()->comment('Unit Kompetensi yang akan dibanding bisa lebih dari 1 data json');
            $table->text('remark')->nullable()->comment('Alasan mengajukan banding');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('member_certification_id')->references('id')->on('member_certification');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_certification_banding');
    }
}
