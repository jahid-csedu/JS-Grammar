<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('id',12)->primary();
            $table->string('name_bangla');
            $table->string('name_english');
            $table->string('father_name_bangla');
            $table->string('father_name_english');
            $table->string('father_profession')->nullable();
            $table->string('father_phone',11)->nullable();
            $table->string('mother_name_bangla');
            $table->string('mother_name_english');
            $table->string('mother_profession')->nullable();
            $table->string('mother_phone',11)->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->integer('academic_year')->unsigned();
            $table->string('class');
            $table->string('section');
            $table->integer('roll')->unsigned();
            $table->string('previous_institute')->nullable();
            $table->date('dob')->nullable();
            $table->string('blood_group',3)->nullable();
            $table->binary('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
