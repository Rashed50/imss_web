<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrType extends Model
{
    use HasFactory;
    protected $primaryKey = 'CrTypeId';
    public $timestamps = false;
}
