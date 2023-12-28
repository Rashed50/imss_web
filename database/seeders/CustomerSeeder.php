<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_infos')->insert([
            'CustName' => 'Rashed' ,
            'CustNameBl' => 'Rashed',
            'TradeName' => 'Rashed Trader',
            'TradeNameBl' => 'Rashed Trader',
            'CustTypeId' => 1,
            'ContactNumber' => '01731540704',
            'Address' => 'dhaka',
            'DueAmount' => 0,
            'InitialDue' => 0,
            'Photo' => 'null',
            'FatherName' => 'na',
            'NID' => '89328402398432',
            'CreateById' => 1,
            'DiviId' => 1,
            'DistId' => 1,
            'ThanId' => 1,
            'UnioId' => 1,

        ]);

        DB::table('customer_infos')->insert([
            'CustName' => 'Salam' ,
            'CustNameBl' => 'Salam' ,
            'TradeName' => 'Salam Traders',
            'TradeNameBl' => 'Salam Traders',
            'CustTypeId' => 2,
            'ContactNumber' => '01987654321',
            'Address' => 'dhaka',
            'DueAmount' => 0,
            'InitialDue' => 0,
            'Photo' => 'null',
            'FatherName' => 'na',
            'NID' => '89328402398432',
            'CreateById' => 1,
            'DiviId' => 1,
            'DistId' => 1,
            'ThanId' => 1,
            'UnioId' => 1,

        ]);
        DB::table('customer_infos')->insert([
            'CustName' => 'Masud' ,
            'CustNameBl' => 'Masud' ,
            'TradeName' => 'Masud Traders',
            'TradeNameBl' => 'Masud Traders',
            'CustTypeId' => 1,
            'ContactNumber' => '01987654321',
            'Address' => 'dhaka',
            'DueAmount' => 0,
            'InitialDue' => 0,
            'Photo' => 'null',
            'FatherName' => 'na',
            'NID' => '89328402398432',
            'CreateById' => 1,
            'DiviId' => 1,
            'DistId' => 1,
            'ThanId' => 1,
            'UnioId' => 1,

        ]);
        DB::table('customer_infos')->insert([
            'CustName' => 'Karim' ,
            'CustNameBl' => 'Karim' ,
            'TradeName' => 'Masud Traders',
            'TradeNameBl' => 'Masud Traders',
            'CustTypeId' => 2,
            'ContactNumber' => '01987654321',
            'Address' => 'dhaka',
            'DueAmount' => 0,
            'InitialDue' => 0,
            'Photo' => 'null',
            'FatherName' => 'na',
            'NID' => '89328402398432',
            'CreateById' => 1,
            'DiviId' => 1,
            'DistId' => 1,
            'ThanId' => 1,
            'UnioId' => 1,

        ]);
    }
}
