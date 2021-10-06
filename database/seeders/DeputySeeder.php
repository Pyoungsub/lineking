<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeputySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('deputies')->insert([
            ['substitute_request_id'=>1, 'user_id'=>2, 'reservedDatetime'=> '2022-12-23 13:00:00', 'amount'=>150000],
            ['substitute_request_id'=>1, 'user_id'=>3, 'reservedDatetime'=> '2022-12-23 13:00:00', 'amount'=>120000],
            ['substitute_request_id'=>1, 'user_id'=>4, 'reservedDatetime'=> '2022-12-23 13:00:00', 'amount'=>100000],
            ['substitute_request_id'=>2, 'user_id'=>2, 'reservedDatetime'=> '2022-12-22 13:00:00', 'amount'=>150000],
            ['substitute_request_id'=>2, 'user_id'=>3, 'reservedDatetime'=> '2022-12-22 13:00:00', 'amount'=>120000],
            ['substitute_request_id'=>2, 'user_id'=>4, 'reservedDatetime'=> '2022-12-22 13:00:00', 'amount'=>100000],
            ['substitute_request_id'=>3, 'user_id'=>2, 'reservedDatetime'=> '2022-12-21 13:00:00', 'amount'=>150000],
            ['substitute_request_id'=>3, 'user_id'=>3, 'reservedDatetime'=> '2022-12-21 13:00:00', 'amount'=>120000],
            ['substitute_request_id'=>3, 'user_id'=>4, 'reservedDatetime'=> '2022-12-21 13:00:00', 'amount'=>100000],
            ['substitute_request_id'=>4, 'user_id'=>2, 'reservedDatetime'=> '2022-12-20 13:00:00', 'amount'=>150000],
            ['substitute_request_id'=>4, 'user_id'=>3, 'reservedDatetime'=> '2022-12-20 13:00:00', 'amount'=>120000],
            ['substitute_request_id'=>4, 'user_id'=>4, 'reservedDatetime'=> '2022-12-20 13:00:00', 'amount'=>100000],
            ['substitute_request_id'=>5, 'user_id'=>2, 'reservedDatetime'=> '2022-12-19 13:00:00', 'amount'=>150000],
            ['substitute_request_id'=>5, 'user_id'=>3, 'reservedDatetime'=> '2022-12-19 13:00:00', 'amount'=>120000],
            ['substitute_request_id'=>5, 'user_id'=>4, 'reservedDatetime'=> '2022-12-19 13:00:00', 'amount'=>100000],
        ]);
    }
}
