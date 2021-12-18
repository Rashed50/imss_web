<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;
     public function Distict(){
         return $this->belongsTo(District::class, 'DistId', 'DistId');
     }

     public function Thana(){
         return $this->belongsTo(Thana::class, 'ThanId', 'ThanId');
     }

     public function CustomerType(){
         return $this->belongsTo(CustomerType::class, 'CustTypeId', 'CusTypeId');
     }
}
