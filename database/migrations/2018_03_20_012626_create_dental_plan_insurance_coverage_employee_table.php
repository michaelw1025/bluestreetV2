<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentalPlanInsuranceCoverageEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dental_plan_insurance_coverage_employee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dental_plan_insurance_coverage_id')->unsigned();
            $table->integer('employee_id')->unsigned();
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
        Schema::dropIfExists('dental_plan_insurance_coverage_employee');
    }
}
