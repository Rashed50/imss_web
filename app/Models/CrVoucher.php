<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrVoucher extends Model
{
    use HasFactory;
    protected $primaryKey = 'CrVoucId';
    protected $guarded = [];
}
