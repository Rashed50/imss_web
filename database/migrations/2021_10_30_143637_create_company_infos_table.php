<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('Logo')->nullable();
            $table->string('Website')->nullable();
            $table->string('Email')->nullable();
            $table->string('InvoiceTitleEn')->nullable();
            $table->string('InvoiceTitleBl')->nullable();
            $table->string('InvoiceTitle2En')->nullable();
            $table->string('InvoiceTitle2Bl')->nullable();
            $table->string('InvoiceDescriptionEn')->nullable();
            $table->string('InvoiceDescriptionBl')->nullable();
            $table->string('InvoiceMobile1')->nullable();
            $table->string('InvoiceMobile2')->nullable();
            $table->string('InvoiceMobile3')->nullable();
            $table->string('InvoiceWaterMarkEn')->nullable();
            $table->string('InvoiceWaterMarkBl')->nullable();
        });
        DB::table('company_infos')->insert([
            'CompTitle' => 'na' ,
            'BengleTitle' => 'na1' ,
            'CompName' => "GN Enterprise",
            'BengleName' => "মেসার্স জিএন এন্টারপ্রাইজ",
            'CompAddress' => "বড় বাজার, মেহেরপুর।",
            'Mobile1' => '0125487',
            'Mobile2' => "0465799987987",
            'Logo' => "GN Traders",
            'Website' => "GN.com",
            'Email' => "Gn@gmail.com",
            'InvoiceTitleEn' => "GN Enterprise",
            'InvoiceTitleBl' => "মেসার্স জিএন এন্টারপ্রাইজ",
            'InvoiceTitle2En' => "GN Enterprise",
            'InvoiceTitle2Bl' => "GN Traders",
            'InvoiceDescriptionEn' => "সিমেন্ট, টিন, ডি ফর্ম, অ্যাঙ্গেল এবং লোহজাত দ্রব্যাদি পাইকারী ও খুচরা বিক্রেতা।",
            'InvoiceDescriptionBl' => "সিমেন্ট, টিন, ডি ফর্ম, অ্যাঙ্গেল এবং লোহজাত দ্রব্যাদি পাইকারী ও খুচরা বিক্রেতা।",
            'InvoiceMobile1' => '০১৬৬৮৪১৯২০' ,
            'InvoiceMobile2' => "০১৭১২০০১১১",
            'InvoiceMobile3' => "০১৭১১১৯৫৭০১",
            'InvoiceWaterMarkEn' => "GN Enterprise",
            'InvoiceWaterMarkBl' => "GN Enterprise",
        ]);


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
