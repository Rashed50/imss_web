<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account_types', function (Blueprint $table) {
            $table->id('BankAcctTypeId');
            $table->string('BankAcctTypeName');
        });

        DB::table('bank_account_types')->insert([ // step 01
            'BankAcctTypeName' => 'Saving Account',
           ]);
           DB::table('bank_account_types')->insert([ // step 01
            'BankAcctTypeName' => 'Checking Account',
           ]);
           

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_account_types');
    }
}
