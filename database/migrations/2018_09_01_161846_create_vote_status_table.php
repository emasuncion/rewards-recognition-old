<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_status', function (Blueprint $table) {
            $table->tinyInteger('votingOpen')->default(0);
            $table->tinyInteger('nominationOpen')->default(0);
        });

        DB::table('vote_status')->insert(['votingOpen' => 0, 'nominationOpen' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voting');
    }
}
