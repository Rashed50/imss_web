<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s_histories', function (Blueprint $table) {
            $table->id('SmsHistId');
            $table->string('MobileNo',30);
            $table->integer('SmsCount');
            $table->string('SmsMassege');
            $table->boolean('IssingleSms');
            $table->date('Date');
            $table->unsignedBigInteger('SendById');
            $table->unsignedBigInteger('CustId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_s_histories');
    }
}
