<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceCoverageVisionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_coverage_vision_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('insurance_coverage_id')->unsigned();
            $table->integer('vision_plan_id')->unsigned();
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
        Schema::dropIfExists('insurance_coverage_vision_plan');
    }
}
