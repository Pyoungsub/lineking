<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('banks')->insert([
            ['bank_name'=> 'KEB하나은행'],
            ['bank_name'=> '경남은행'],
            ['bank_name'=> '광주은행'],
            ['bank_name'=> '국민은행'],
            ['bank_name'=> '기업은행'],
            ['bank_name'=> '농협중앙회'],
            ['bank_name'=> '대구은행'],
            ['bank_name'=> '부산은행'],
            ['bank_name'=> '산업은행'],
            ['bank_name'=> '새마을금고'],
            ['bank_name'=> '수협'],
            ['bank_name'=> '신한은행'],
            ['bank_name'=> '신협'],
            ['bank_name'=> '우리은행'],
            ['bank_name'=> '우체국'],
            ['bank_name'=> '전북은행'],
            ['bank_name'=> '제주은행'],
            ['bank_name'=> '지역농축협'],
            ['bank_name'=> '카카오뱅크'],
            ['bank_name'=> '케이뱅크'],
            ['bank_name'=> '한국씨티은행'],
        ]);
    }
}
