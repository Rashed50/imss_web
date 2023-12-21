<?php

namespace App\Http\Controllers\DataLayers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class ItemsDataService {


    

    // public function GetAllCategoryRecordsForDropdownlist(){

    //     return Categery::select('CatId','CatName')->get();
  
    // }
    
    public function GetAllActiveCategoryRecords(){

       return Categery::get();
 
    }
}