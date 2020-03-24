<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id');
            $table->bigInteger('loan_id')->unsigned();
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('date');
            $table->float('discount_perc')->default(0);
            $table->float('paid_amount');
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
        Schema::dropIfExists('loan_pays');
    }
}
