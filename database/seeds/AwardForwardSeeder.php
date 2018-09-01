<?php

use Illuminate\Database\Seeder;

class AwardForwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AwardForward::class, 20)->create();
    }
}
