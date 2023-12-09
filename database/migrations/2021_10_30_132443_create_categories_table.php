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
            $table->string('CateBLName');
            $table->boolean('CateStatus')->default(true);
           // $table->timestamps();
        });


        DB::table('categories')->insert([
            'CateName' => 'Road' 
        ]);
        DB::table('categories')->insert([
            'CateName' => 'Cement' 
        ]);
        DB::table('categories')->insert([
            'CateName' => 'Tin' 
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
