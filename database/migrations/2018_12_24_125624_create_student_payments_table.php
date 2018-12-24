<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('type');
            $table->integer('trx_id')->unsigned();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->string('exam_name')->nullable();
            $table->timestamps();

            $table->foreign('trx_id')->references('id')->on('transactions');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_payments');
    }
}
