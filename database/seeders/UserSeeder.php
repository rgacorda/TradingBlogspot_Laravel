<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

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
            'first_name' => 'I',
            'middle_name' => 'am',
            'last_name' => 'admin',
            'bio' => 'I am admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'role_id' => 1
        ]);
        DB::table('users')->insert([
            'first_name' => 'I',
            'middle_name' => 'am',
            'last_name' => 'user',
            'bio' => 'I am user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123123123'),
            'role_id' => 2
        ]);
    }
}
