<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id('ChartOfAcctId');
            $table->string('ChartOfAcctName');
            $table->string('ChartOfAcctNumber')->nullable();

            $table->integer('AccountId')->default(0);
            $table->unsignedBigInteger('AcctBalance')->default(0);
            $table->date('OpeningDate');
            $table->boolean('ActiveStatus')->default(true);
            $table->boolean('IsTransaction')->default(false);
            $table->boolean('IsPredefined')->default(false);
            $table->string('BankAcctNumber')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('BankId');
            $table->foreign('BankId')->references('BankId')->on('banks');

            $table->unsignedBigInteger('AcctTypeId');
            $table->foreign('AcctTypeId')->references('AcctTypeId')->on('account_types');

            $table->unsignedBigInteger('BankAcctTypeId');
            $table->foreign('BankAcctTypeId')->references('BankAcctTypeId')->on('bank_account_types');

        });

        /* insert data in database */
    /*
        DB::table('chart_of_accounts')->insert([ // step 01
          'ChartOfAcctId' => 1,
          'ChartOfAcctName' => 'Chart Of Account Name 01',
          'ChartOfAcctNumber' => 'Chart Of Account Number 01',
          'OpeningDate' => '2022-02-25',
          'BankAcctNumber' => '33949734389',
          'BankId' => 1,
          'AcctTypeId' => 1,
          'BankAcctTypeId' => 1,
        ]);

        DB::table('chart_of_accounts')->insert([ // step 02
          'ChartOfAcctId' => 2,
          'ChartOfAcctName' => 'Chart Of Account Name 02',
          'ChartOfAcctNumber' => 'Chart Of Account Number 02',
          'OpeningDate' => '2022-02-25',
          'BankAcctNumber' => '33949734389',
          'BankId' => 2,
          'AcctTypeId' => 2,
          'BankAcctTypeId' => 2,
        ]);

*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_of_accounts');
    }
}
