<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id');
            $table->string('date');
            $table->string('present_status');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('checkin_time');
            $table->string('checkout_time')->nullable();
            $table->string('checkout_longitude')->nullable();
            $table->string('checkout_latitude')->nullable();
            $table->string('wifi_ssid')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('attendances');
    }
}
