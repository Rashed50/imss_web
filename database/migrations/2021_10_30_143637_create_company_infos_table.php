<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id('CompId');
            $table->string('CompTitle');
            $table->string('BengleTitle')->nullable();
            $table->string('CompName');
           // $table->string('ownerName');
            $table->string('BengleName')->nullable();
            $table->string('CompAddress');
            $table->string('Mobile1');
            $table->string('Mobile2')->nullable();
          //  $table->string('TelPhone')->nullable();
           // $table->string('Fax')->nullable();
            $table->string('Logo');
            $table->string('Website')->nullable();
            $table->string('Email');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
}
