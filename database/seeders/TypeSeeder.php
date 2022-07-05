<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'typeName' => '主食'
            ],
            [
                'typeName' => '主菜'
            ],
            [
                'typeName' => '副菜'
            ],
            [
                'typeName' => '汁物'
            ],
            [
                'typeName' => 'デザート'
            ],
        ]);
    }
}
