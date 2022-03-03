<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSellRecord extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class,'CateId', 'CateId');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'BranId', 'BranId');
    }
    public function size(){
        return $this->belongsTo(Size::class,'SizeId', 'SizeId');
    }
    public function thickness(){
        return $this->belongsTo(Thickness::class,'ThicId', 'ThicId');
    }
}
