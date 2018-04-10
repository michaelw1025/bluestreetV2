<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractor_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contractor_id')->unsigned();
            $table->string('contractor_employee_first_name');
            $table->string('contractor_employee_last_name');
            $table->dateTime('training_completion_date')->nullable();
            $table->dateTime('re_training_due_date')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('contractor_trainings');
    }
}
