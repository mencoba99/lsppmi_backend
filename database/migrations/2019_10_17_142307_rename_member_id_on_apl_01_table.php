<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMemberIdOnApl01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_certification_apl_01', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->renameColumn('member_id', 'member_certification_id');

            $table->foreign('member_certification_id')->references('id')->on('member_certification');
        });

        Schema::table('member_certification_apl_02', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
            $table->renameColumn('member_id', 'member_certification_id');

            $table->foreign('member_certification_id')->references('id')->on('member_certification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_certification_apl_01', function (Blueprint $table) {
            $table->dropForeign(['member_certification_id']);
            $table->renameColumn('member_certification_id', 'member_id');

            $table->foreign('member_id')->references('id')->on('members');
        });

        Schema::table('member_certification_apl_02', function (Blueprint $table) {
            $table->dropForeign(['member_certification_id']);
            $table->renameColumn('member_certification_id', 'member_id');

            $table->foreign('member_id')->references('id')->on('members');
        });
    }
}
