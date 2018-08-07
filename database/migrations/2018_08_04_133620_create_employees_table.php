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
            $table->string('name', 32)->notNull();
            $table->tinyInteger('voted')->notNull();
        });

        DB::table('employees')->insert([
            ['name' => 'Errol Asuncion', 'voted' => 0],
            ['name' => 'Shane Camus', 'voted' => 0],
            ['name' => 'James Bernardez', 'voted' => 0],
            ['name' => 'Ariel Tabag', 'voted' => 0],
            ['name' => 'Francis Mergano', 'voted' => 0],
            ['name' => 'David De Chavez', 'voted' => 0],
            ['name' => 'Paul Balila', 'voted' => 0],
            ['name' => 'Annah Chua', 'voted' => 0],
            ['name' => 'Adrian Idos', 'voted' => 0],
            ['name' => 'Eunice Gelacio', 'voted' => 0],
            ['name' => 'Lorica Liwanag', 'voted' => 0],
            ['name' => 'TJ Oliva', 'voted' => 0],
            ['name' => 'Michelle Ng', 'voted' => 0],
            ['name' => 'Tina Dela Cruz', 'voted' => 0],
            ['name' => 'May Buenaventura', 'voted' => 0],
            ['name' => 'Gerard Gahol', 'voted' => 0],
            ['name' => 'Sarah Quijano', 'voted' => 0],
            ['name' => 'Meg Lafuente', 'voted' => 0],
            ['name' => 'Carl Godoy', 'voted' => 0],
            ['name' => 'Renzo Sunico', 'voted' => 0],
            ['name' => 'Jes Tañada', 'voted' => 0],
            ['name' => 'Carlson Orozco', 'voted' => 0],
            ['name' => 'Admin', 'voted' => 0],
            ['name' => 'Guest', 'voted' => 0],
        ]);
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
