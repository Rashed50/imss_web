<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id('TranTypeId');
            $table->string('TranTypeName');
        });

        // Cement
        DB::table('transaction_types')->insert([
            'TranTypeName' => 'Purchase' ,
        ]);
        DB::table('transaction_types')->insert([
            'TranTypeName' => 'Sell' ,
        ]);
        DB::table('transaction_types')->insert([
            'TranTypeName' => 'Deu Payment' ,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
}
