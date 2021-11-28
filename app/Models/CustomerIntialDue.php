<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerIntialDue extends Model
{
    use HasFactory;
    protected $primaryKey = "CustIntiDuesId";
    protected $guarded = [];

    public function Customer(){
      return $this->belongsTo(CustomerInfo::class,'CustId','CustId');
    }
}
