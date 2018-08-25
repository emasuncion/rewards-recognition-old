<?php

use Illuminate\Database\Seeder;

class NominationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $min = 1;
        $max = 11;
        $max2 = 3;
        $first = range($min, $max);
        $second = range($min, $max2);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('nominations')->insert([
            'user_id' => shuffle($first),
            'nominee' => str_random(10),
            'category' => shuffle($second),
            'explanation' => str_random(20),
            'quarter' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
