<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('regencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('province_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces');            
        });

        Schema::create('program_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        // TUK
        Schema::create('competence_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('regency_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address');
            $table->text('contact');
            $table->point('position')->nullable(); // Latitude, Longitude here
            $table->tinyInteger('status')->default(1); // 1=Active, 0=Inactive
            $table->timestamps();

            $table->foreign('regency_id')->references('id')->on('regencies');
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_type_id');
            $table->string('code');
            $table->string('name');
            $table->string('abbreviation_id');
            $table->string('abbreviation_en');
            $table->text('description')->nullable();
            $table->integer('min_competence')->default(1);
            $table->integer('level')->default(1);
            $table->jsonb('type'); // {"direct": ["cbt", "obs"]} / {"indirect": ["obs"]}
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('program_type_id')->references('id')->on('program_type');
        });

        Schema::create('competence_unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('type')->default(1); // SKKNI/SI/SK
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();
        });

        Schema::create('competence_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('competence_unit_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('competence_unit_id')->references('id')->on('competence_units')->onDelete('cascade');
        });

        Schema::create('competence_kuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('competence_element_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('competence_element_id')->references('id')->on('competence_elements')->onDelete('cascade');
        });

        Schema::create('program_competence_unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id');
            $table->integer('competence_unit_id');
            $table->tinyInteger('is_required')->default(1);
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('competence_unit_id')->references('id')->on('competence_units')->onDelete('cascade');
        });

        Schema::create('program_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token');
            $table->integer('program_id');
            $table->integer('competence_place_id');
            $table->integer('price');
            $table->integer('min_participants')->default(1);
            $table->decimal('training_duration', 5, 1);
            $table->decimal('exam_duration', 5, 1);
            $table->tinyInteger('is_hidden')->default(0); // 0=Show, 1=hidden
            $table->dateTime('started_at');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('competence_place_id')->references('id')->on('competence_places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competence_kuk');
        Schema::dropIfExists('competence_elements');
        Schema::dropIfExists('program_schedules');
        Schema::dropIfExists('program_competence_unit');
        Schema::dropIfExists('competence_units');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('program_type');
        Schema::dropIfExists('competence_places');
        Schema::dropIfExists('regencies');
        Schema::dropIfExists('provinces');
    }
}
