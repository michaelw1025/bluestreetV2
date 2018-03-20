<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spouses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_initial')->nullable();
            $table->string('ssn');
            $table->dateTime('birth_date');
            $table->string('gender');
            $table->boolean('domestic_partner')->nullable();
            $table->boolean('has_medical')->nullable();
            $table->boolean('has_dental')->nullable();
            $table->boolean('has_vision')->nullable();
            $table->boolean('court_ordered')->nullable();
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
        Schema::dropIfExists('spouses');
    }
}
