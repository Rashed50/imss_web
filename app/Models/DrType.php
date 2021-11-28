<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrType extends Model
{
    use HasFactory;
    protected $primaryKey = 'DrTypeId';
    protected $guarded = [];
    public $timestamps = false;
}
