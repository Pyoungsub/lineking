<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('states')->insert([
            ['state_name'=>'서울'],
            ['state_name'=>'강원'],
            ['state_name'=>'충남'],
            ['state_name'=>'충북'],
            ['state_name'=>'전남'],
            ['state_name'=>'전북'],
            ['state_name'=>'대구'],
            ['state_name'=>'대전'],
            ['state_name'=>'부산'],
            ['state_name'=>'울산'],
            ['state_name'=>'인천'],
            ['state_name'=>'광주'],
            ['state_name'=>'경기'],
            ['state_name'=>'경남'],
            ['state_name'=>'경북'],
            ['state_name'=>'제주'],
            ['state_name'=>'세종'],
        ]);
    }
}
