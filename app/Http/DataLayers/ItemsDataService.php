<?php

namespace App\Http\DataLayers;
use App\Models\Category;

class ItemsDataService {

    public function GetAllCategoryRecordsForDropdownlist(){

        return Category::get();
  
     }
    
    public function GetAllActiveCategoryRecords(){

       return Category::where('CateStatus',true)->orderBy('CateId','DESC')->get();
 
    }
}