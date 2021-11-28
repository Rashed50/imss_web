<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class demodata extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $table->string('CateName')->unique();
       // $table->boolean('CateStatus')->default(true);

        DB::table('categories')->insert([
            'CateName' => 'Cement' 
        ]);
    }
}
