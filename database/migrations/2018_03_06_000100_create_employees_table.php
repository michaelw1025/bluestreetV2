<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_initial')->nullable();
            $table->string('ssn');
            $table->string('oracle_number')->nullable();
            $table->dateTime('birth_date');
            $table->dateTime('hire_date');
            $table->dateTime('service_date');
            $table->string('maiden_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('gender');
            $table->string('suffix')->nullable();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('county');
            $table->boolean('status');
            $table->boolean('rehire');
            $table->boolean('bid_eligible');
            $table->dateTime('bid_eligible_date')->nullable();
            $table->text('bid_eligible_comment')->nullable();
            $table->boolean('thirty_day_review')->nullable();
            $table->boolean('sixty_day_review')->nullable();
            $table->boolean('vitality_incentive')->nullable();
            $table->decimal('flex_spending_amount', 8, 2)->nullable();
            $table->decimal('hsa_amount', 8, 2)->nullable();
            $table->decimal('child_care_spending_amount', 8, 2)->nullable();
            $table->string('employee_optional_life')->nullable();
            $table->decimal('spouse_optional_life', 8, 2)->nullable();
            $table->decimal('dependant_optional_life', 8, 2)->nullable();

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
        Schema::dropIfExists('employees');
    }
}
