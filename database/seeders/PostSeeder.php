<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'type_id' => 1,
                'foodname' => 'テリヤキバーガー(マック)',
                'content' => 'testです。',
                'filename' => '/images/hanbuger.jpg',
                'calorie' => 478,
                'carbon' => 15.8,
                'protein' => 23.2,
                'fat' => 15.5,
            ],
            [
                'user_id' => 2,
                'type_id' => 2,
                'foodname' => '鮭の塩焼き(75g)',
                'content' => 'testです。',
                'filename' => '/images/salmon.jpg',
                'calorie' => 120,
                'carbon' => 0.1,
                'protein' => 17.8,
                'fat' => 3.5,
            ],
        ]);
    }
}
