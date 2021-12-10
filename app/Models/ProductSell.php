<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerInfo;
class ProductSell extends Model
{
    use HasFactory;

        public function Customer(){
           return $this->belongsTo(CustomerInfo::class, 'CustId', 'CustId');
        }
}
