<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dr_types', function (Blueprint $table) {
            $table->id('DrTypeId');
            $table->string('DrTypeName');
            $table->timestamps();
        });

        DB::table('dr_types')->insert([
            'DrTypeName' => 'Transportation Expense'  
        ]);

        DB::table('dr_types')->insert([
            'DrTypeName' => 'Office Expense'  
        ]);

        DB::table('dr_types')->insert([
            'DrTypeName' => 'Employee Salary'  
        ]);

       

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dr_types');
    }
}
