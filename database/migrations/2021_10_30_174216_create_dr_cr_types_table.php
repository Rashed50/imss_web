<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrCrTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dr_cr_types', function (Blueprint $table) {
            $table->id('DrCrTypeId');
            $table->string('TypeName');
         });


         DB::table('dr_cr_types')->insert([
            'TypeName' => 'Debit'
        ]);

        DB::table('dr_cr_types')->insert([
            'TypeName' => 'Credit'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dr_cr_types');
    }
}
