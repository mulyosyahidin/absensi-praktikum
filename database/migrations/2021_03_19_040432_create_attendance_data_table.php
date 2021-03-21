<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('attendance_status')->nullable();

            $table->index('meeting_id');
            $table->index('student_id');
            $table->index('attendance_status');

            $table->foreign('meeting_id')->references('id')->on('attendance_meetings')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->foreign('attendance_status')->references('id')->on('attendance_statuses')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_data');
    }
}
