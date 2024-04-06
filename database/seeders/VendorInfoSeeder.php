<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        Vendor::insert([
            'VendName' => 'ABC Vendor' ,
            'ContactName' => 'ABC Vendor',
            'VendAddress' => 'ABC Vendor',
            'Mobile1' => '85296374',            
            'Balance' => 0,
            'InitialBalance' => 0,
            'OpeningDate' => '2024-05-02',
            'CreateById' => 1,
            'ChartOfAcctId' => '1',
  
        ]);
    }
}
