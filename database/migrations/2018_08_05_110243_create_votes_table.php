<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nominee_value_creator', 32)->nullable();
            $table->string('nominee_people_developer', 32)->nullable();
            $table->string('nominee_business_operator', 32)->nullable();
            $table->text('explanation_value_creator', 255)->nullable();
            $table->text('explanation_people_developer', 255)->nullable();
            $table->text('explanation_business_operator', 255)->nullable();
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
        Schema::dropIfExists('votes');
    }
}
