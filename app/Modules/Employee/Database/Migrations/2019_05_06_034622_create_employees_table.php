<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('p_address')->nullable();
            $table->string('t_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('department_id')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('featured_image')->nullable();
            $table->bigInteger('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('salary_levels');
            $table->string('mode_of_pay')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('resume')->nullable();
            $table->string('id_proof')->nullable();
            $table->string('other_document')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('citizenship_no')->nullable();
            $table->string('nationality')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
