<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentalPlanInsuranceCoverageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dental_plan_insurance_coverage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dental_plan_id')->unsigned();
            $table->integer('insurance_coverage_id')->unsigned();
            $table->decimal('amount', 8, 2);
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
        Schema::dropIfExists('dental_plan_insurance_coverage');
    }
}
