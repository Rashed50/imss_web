<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSellRecord extends Model
{
    use HasFactory;

    public function Category(){
        return $this->belongsTo(Category::class,'CateId', 'CateId');
    }
    public function Brand(){
        return $this->belongsTo(Brand::class,'BranId', 'BranId');
    }
    public function Size(){
        return $this->belongsTo(Size::class,'SizeId', 'SizeId');
    }
    public function Thickness(){
        return $this->belongsTo(Thickness::class,'ThicId', 'ThicId');
    }
}
