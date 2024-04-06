<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
 

            $this->call(PermissionTableSeeder::class);
            $this->call(AdminUserSeeder::class);
            $this->call(DivisionSeeder::class);
            $this->call(ItemsSeeder::class);
            $this->call(ChartOfAccountSeeder::class);
            $this->call(CustomerSeeder::class);
            $this->call(VendorInfoSeeder::class);           
            $this->call(CustomerPaymentSeeder::class);            
            $this->call(VendorPaymentSeeder::class);
            $this->call(CrVoucherSeeder::class);
            $this->call(DrVoucherSeeder::class);
             
  

    }
}
