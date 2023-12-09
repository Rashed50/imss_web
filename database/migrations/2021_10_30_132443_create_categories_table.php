<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('CateId');
            $table->string('CateName')->unique();
            $table->string('CateBlName');
            $table->boolean('CateStatus')->default(true);
           // $table->timestamps();
        });


        DB::table('categories')->insert([
            'CateName' => 'Road', 
            'CateBlName'=>'Road1'
        ]);
        
        DB::table('categories')->insert([
            'CateName' => 'Cement',
            'CateBlName'=>'Cement1' 
        ]);
      
        DB::table('categories')->insert([
            'CateName' => 'Tin',
            'CateBlName'=>'Tin1' 
        ]);
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
