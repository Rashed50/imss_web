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

        /* insert data in database */
        DB::table('bank_account_types')->insert([ // step 01
          'BankAcctTypeId' => 1,
          'BankAcctTypeName' => 'Bank Account Type 01'
        ]);

        DB::table('bank_account_types')->insert([ // step 02
          'BankAcctTypeId' => 2,
          'BankAcctTypeName' => 'Bank Account Type 02'
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
