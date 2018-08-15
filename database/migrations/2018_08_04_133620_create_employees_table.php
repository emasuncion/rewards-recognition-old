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
            $table->tinyInteger('active')->notNull();
        });

        DB::table('employees')->insert([
            ['name' => 'Errol Asuncion', 'voted' => 0, 'active' => 1],
            ['name' => 'Shane Camus', 'voted' => 0, 'active' => 1],
            ['name' => 'James Bernardez', 'voted' => 0, 'active' => 1],
            ['name' => 'Ariel Tabag', 'voted' => 0, 'active' => 1],
            ['name' => 'Francis Mergano', 'voted' => 0, 'active' => 1],
            ['name' => 'David De Chavez', 'voted' => 0, 'active' => 1],
            ['name' => 'Paul Balila', 'voted' => 0, 'active' => 1],
            ['name' => 'Annah Chua', 'voted' => 0, 'active' => 1],
            ['name' => 'Adrian Idos', 'voted' => 0, 'active' => 1],
            ['name' => 'Eunice Gelacio', 'voted' => 0, 'active' => 1],
            ['name' => 'Lorica Liwanag', 'voted' => 0, 'active' => 1],
            ['name' => 'TJ Oliva', 'voted' => 0, 'active' => 1],
            ['name' => 'Michelle Ng', 'voted' => 0, 'active' => 1],
            ['name' => 'Tina Dela Cruz', 'voted' => 0, 'active' => 1],
            ['name' => 'May Buenaventura', 'voted' => 0, 'active' => 1],
            ['name' => 'Gerard Gahol', 'voted' => 0, 'active' => 1],
            ['name' => 'Sarah Quijano', 'voted' => 0, 'active' => 1],
            ['name' => 'Meg Lafuente', 'voted' => 0, 'active' => 1],
            ['name' => 'Carl Godoy', 'voted' => 0, 'active' => 1],
            ['name' => 'Renzo Sunico', 'voted' => 0, 'active' => 1],
            ['name' => 'Jes Tañada', 'voted' => 0, 'active' => 1],
            ['name' => 'Carlson Orozco', 'voted' => 0, 'active' => 1],
            ['name' => 'Admin', 'voted' => 0, 'active' => 1],
            ['name' => 'Guest', 'voted' => 0, 'active' => 1],
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
