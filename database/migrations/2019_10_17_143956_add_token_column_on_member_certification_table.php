<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenColumnOnMemberCertificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_certification', function (Blueprint $table) {
            $table->string('token')->default(substr(sha1(rand()), 0, 32));
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
            $table->dropColumn('token');
        });
    }
}
