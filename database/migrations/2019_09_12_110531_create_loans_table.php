<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id');
            $table->bigInteger('loan_type_id')->unsigned();
            $table->foreign('loan_type_id')->references('id')->on('loan_types');
            $table->string('loan_date');
            $table->float('loan_amount');
            $table->float('repayment_amount');
            $table->string('repayment_date');
            $table->longText('description');
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('loans');
    }
}
