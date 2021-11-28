<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;
    public function Customer(){
      return $this->belongsTo('App\Models\CustomerInfo','CustId','CustId');
    }

    public function Employee(){
      return $this->belongsTo('App\Models\EmployeeInformation','MoneyReciveBy','EmplInfoId');
    }

}
