<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id('BranId');
            $table->unsignedBigInteger('CateId');
            $table->string('BranName');
            $table->string('BranBlName');
            $table->boolean('BranStatus')->default(true);
            $table->foreign('CateId')->references('CateId')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });


        // Cement
        DB::table('brands')->insert([
            'BranName' => 'Holcim' ,
            'BranBlName'=>'Holcim1',
            'CateId' => 1
        ]);
        DB::table('brands')->insert([
            'BranName' => 'OPC' ,
            'BranBlName'=>'OPC1',
            'CateId' => 1
        ]);
        DB::table('brands')->insert([
            'BranName' => 'Bengle' ,
            'BranBlName'=>'Bengle1',
            'CateId' => 1
        ]);

// Rod
        DB::table('brands')->insert([
            'BranName' => 'BSRM' ,
            'BranBlName'=>'BSRM1',
            'CateId' => 2
        ]);
        DB::table('brands')->insert([
            'BranName' => 'PSRM' ,
            'BranBlName'=>'PSRM1',
            'CateId' => 2
        ]);
        DB::table('brands')->insert([
            'BranName' => 'CSRM' ,
            'BranBlName'=>'CSRM1',
            'CateId' => 2
        ]);

// Tin
        DB::table('brands')->insert([
            'BranName' => 'Morgi Marka' ,
            'BranBlName'=>'Morgi Marka1',
            'CateId' => 3
        ]);
        DB::table('brands')->insert([
            'BranName' => 'KY' ,
            'BranBlName'=>'KY1',
            'CateId' => 3
        ]);
        DB::table('brands')->insert([
            'BranName' => 'Horse' ,
            'BranBlName'=>'Horse1',
            'CateId' => 3
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
