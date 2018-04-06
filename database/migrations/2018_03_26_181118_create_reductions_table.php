<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->boolean('currently_active')->nullable();
            $table->string('type');
            $table->string('displacement');
            $table->dateTime('date');
            $table->string('home_cost_center');
            $table->string('bump_to_cost_center')->nullable();
            $table->string('home_shift');
            $table->string('bump_to_shift')->nullable();
            $table->string('fiscal_week')->nullable();
            $table->string('fiscal_year')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->longText('comments');
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
        Schema::dropIfExists('reductions');
    }
}
