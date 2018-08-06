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
            $table->string('nominee_value_creator')->notNullable();
            $table->string('nominee_people_developer')->notNullable();
            $table->string('nominee_business_operator')->notNullable();
            $table->text('explanation_value_creator', 255)->notNullable();
            $table->text('explanation_people_developer', 255)->notNullable();
            $table->text('explanation_business_operator', 255)->notNullable();
            $table->timestamps();
            // $table->name('voted_by')->notNullable();
            // $table->foreign('voted_by')->references('name')->table('employees')->onUpdate('CASCADE')->onDelete('CASCADE');
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
