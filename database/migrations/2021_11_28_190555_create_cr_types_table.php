<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cr_types', function (Blueprint $table) {
            $table->id('CrTypeId');
            $table->string('CrTypeName');
        });

        DB::table('cr_types')->insert([
            'CrTypeName' => 'Abuse Materials'  
        ]);

        DB::table('cr_types')->insert([
            'CrTypeName' => 'Others'  
        ]); 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cr_types');
    }
}
