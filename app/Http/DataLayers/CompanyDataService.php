<?php

namespace App\Http\DataLayers;

use App\Models\CompanyInfo;

class CompanyDataService{

    public function getCompanyProfileInformation(){
        return  CompanyInfo::where('CompId',1)->firstOrFail();
    }
}