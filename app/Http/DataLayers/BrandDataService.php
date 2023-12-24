<?php

namespace App\Http\DataLayers;
use App\Models\Brand;

class BrandDataService {

    public function getAllActiveBrandRecords(){

       return Brand::with('cateInfo')->where('BranStatus', true)->orderBy('BranId', 'DESC')->get();
 
    }
}