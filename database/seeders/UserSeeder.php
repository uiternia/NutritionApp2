<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test@test.com',
                'password' => Hash::make('passworddesu')
            ],
            [
                'name' => 'test2',
                'email' => 'test1@test.com',
                'password' => Hash::make('passworddesu')
            ],
        ]);
    }
}
