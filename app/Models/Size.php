<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function brandInfo(){
        return $this->belongsTo(Brand::class, 'BranId', 'BranId');
    }
}
