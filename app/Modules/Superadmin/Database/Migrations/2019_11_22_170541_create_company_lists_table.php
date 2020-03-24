<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('short_name');
            $table->string('phone');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('country');
            $table->string('currency');
            $table->string('contact_person');
            $table->string('logo');
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
        Schema::dropIfExists('company_lists');
    }
}
