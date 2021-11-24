<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_information', function (Blueprint $table) {
            $table->id('EmplInfoId');
            $table->string('Name');
            $table->integer('DesignationId');
            $table->string('ContactNumber');
            $table->string('Village')->nullable();
            $table->string('FatherName')->nullable();
            $table->string('Photo')->nullable();
            $table->date('JoinDate')->nullable();
            $table->date('ReviewDate')->nullable();
            $table->float('Salary',11,2)->default(0);
            $table->string('PostOffice')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('DiviId');
            $table->unsignedBigInteger('DistId');
            $table->unsignedBigInteger('ThanId');
            $table->unsignedBigInteger('UnioId');

            $table->foreign('DiviId')->references('DiviId')->on('divisions')->onDelete('cascade');
            $table->foreign('DistId')->references('DistId')->on('districts')->onDelete('cascade');
            $table->foreign('ThanId')->references('ThanId')->on('thanas')->onDelete('cascade');
            $table->foreign('UnioId')->references('UnioId')->on('unions')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_information');
    }
}
