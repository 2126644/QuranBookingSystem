<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('session_day', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
            $table->enum('session_time', ['9am - 10am with Ustaz Muazzam','2pm - 3pm with Ustazah Hanum','5pm - 6pm with Ustaz Zaid Muhammad','8pm - 9pm with Ustazah Ain Lily']);
            $table->enum('class_type', ['Iqra', 'Al-Quran']);
            $table->enum('session_type', ['Online', 'In-Person']);
            $table->enum('study_level', ['Beginner', 'Intermediate', 'Advanced']);
            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
