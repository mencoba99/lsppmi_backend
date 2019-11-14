<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMemberCertificationChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_certification_chat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_certification_id')->nullable();
            $table->unsignedInteger('member_id')->nullable()->comment('Jika chat dari peserta');
            $table->unsignedInteger('user_id')->nullable()->comment('Jika Chat dari admin/Assessor');
            $table->tinyInteger('chat_type',false, true)->nullable()->comment('1=APL-01, 2=APL-02, 3=General');
            $table->text('message')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('member_certification_id')->references('id')->on('member_certification');
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_certification_chat');
    }
}
