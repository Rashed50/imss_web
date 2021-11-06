<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id('AcctTypeId');
            $table->string('AcctTypeName');
        });

        /* insert data in database */

        DB::table('account_types')->insert([ // step 01
          'AcctTypeId' => 1,
          'AcctTypeName' => 'Account Type 01'
        ]);

        DB::table('account_types')->insert([ // step 02
          'AcctTypeId' => 2,
          'AcctTypeName' => 'Account Type 02'
        ]);




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_types');
    }
}
