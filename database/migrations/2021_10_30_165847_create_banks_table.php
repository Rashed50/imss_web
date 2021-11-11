<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id('BankId');
            $table->string('BankName');
            $table->string('BankAddress');
            $table->string('Contact');
        });

        /* insert data in database */
        DB::table('banks')->insert([ // step 01
          'BankId' => 1,
          'BankName' => 'Bank Name 01',
          'BankAddress' => 'Bank Address 01',
          'Contact' => 'Contact 01',
        ]);

        DB::table('banks')->insert([ // step 02
          'BankId' => 2,
          'BankName' => 'Bank Name 02',
          'BankAddress' => 'Bank Address 02',
          'Contact' => 'Contact 02',
        ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
