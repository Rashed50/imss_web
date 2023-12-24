<?php

namespace App\Http\DataLayers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;

class ItemsDataService {

    public function GetAllCategoryRecordsForDropdownlist(){

        return Category::get();
  
     }
    
    public function GetAllActiveCategoryRecords(){

       return Category::where('CateStatus',true)->orderBy('CateId','DESC')->get();
 
    }

    public function getAllActiveBrandRecords(){

        return Brand::with('cateInfo')->where('BranStatus', true)->orderBy('BranId', 'DESC')->get();
  
    }

    public function getAllActiveSizeRecords(){

        return Size::with('cateInfo', 'brandInfo')->where('SizeStatus', true)->orderBy('SizeId', 'DESC')->get();
  
     }
}