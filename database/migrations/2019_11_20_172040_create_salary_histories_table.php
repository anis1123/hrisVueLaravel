<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employees');
            $table->bigInteger('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('salary_levels');
            $table->string('date');
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
        Schema::dropIfExists('salary_histories');
    }
}
