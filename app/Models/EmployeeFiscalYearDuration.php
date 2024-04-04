<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFiscalYearDuration extends Model
{
    use HasFactory;
    protected $table = "employee_fiscal_closing_records";
    protected $fillable = ['emp_auto_id','start_month','start_year','start_date','balance_amount'];

}
