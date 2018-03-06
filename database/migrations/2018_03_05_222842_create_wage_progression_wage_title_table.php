<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWageProgressionWageTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wage_progression_wage_title', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_progression_id')->unsigned();
            $table->integer('wage_title_id')->unsigned();
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
        Schema::dropIfExists('wage_progression_wage_title');
    }
}
