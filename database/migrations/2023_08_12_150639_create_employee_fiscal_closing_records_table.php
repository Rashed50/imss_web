<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeFiscalClosingRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_fiscal_closing_records', function (Blueprint $table) {
            $table->id('efcr_auto_id');
            $table->integer('emp_auto_id');
            $table->integer('start_month');
            $table->integer('end_month')->nullable();
            $table->integer('start_year');
            $table->integer('end_year')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->float('balance_amount')->default(0);
            $table->boolean('closing_status')->default(0);
            $table->string('remarks')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('employee_fiscal_closing_records');
    }
}
