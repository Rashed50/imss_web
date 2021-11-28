<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellReturnRecord extends Model
{
    use HasFactory;
    protected $primaryKey = "SellRetuRecoId";
    protected $guarded = [];
    public $timestamps = false;
}
