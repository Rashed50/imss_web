<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_types', function (Blueprint $table) {
            $table->id('CusTypeId');
            $table->string('TypeName',50)->nullable();
        });

        DB::table('customer_types')->insert([
            'TypeName' => 'ReSeller'
         ]);
         DB::table('customer_types')->insert([
            'TypeName' => 'User'
         ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_types');
    }
}
