<?php

namespace Database\Seeders;

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
            ['name'=>'David', 'email'=>'ps.shim87@gmail.com', 'state_id'=>1, 'city_id'=>1, 'password'=>Hash::make('password')],
            ['name'=>'구글', 'email'=>'google@gmail.com', 'state_id'=>1, 'city_id'=>1, 'password'=>Hash::make('password')],
            ['name'=>'테스트', 'email'=>'test@test.com', 'state_id'=>1, 'city_id'=>1, 'password'=>Hash::make('password')],
            ['name'=>'네이버', 'email'=>'naver@naver.com', 'state_id'=>1, 'city_id'=>1, 'password'=>Hash::make('password')],
        ]);
    }
}
