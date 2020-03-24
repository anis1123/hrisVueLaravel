<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->string('name');
            $table->string('basic_salary');
            $table->string('session_year');
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
        Schema::dropIfExists('salary_levels');
    }
}
