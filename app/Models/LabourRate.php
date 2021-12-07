<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourRate extends Model
{
    use HasFactory;
     public function cateInfo(){
        return $this->belongsTo(Category::class, 'CateId', 'CateId');
    }

    public function sizeInfo(){
        return $this->belongsTo(Size::class, 'SizeId', 'SizeId');
    }
}
