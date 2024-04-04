<?php

namespace App\Http\DataLayers;

use App\Models\Vendor;
use Carbon\Carbon;

class VendorDataService{

    public function insertNewVendorInformation($vendorName,$contactName,$mobileNo,$address,$date,$balance,$initialBalance,$vendorAccId,$insertedBy){

       return Vendor::insertGetId([
            'VendName'=> $vendorName,
            'ContactName'=>$contactName,
            'Mobile1'=>$mobileNo,
            'OpeningDate'=>$date,
            'Balance'=>$balance,
            'InitialBalance'=>$initialBalance,
            'ChartOfAcctId'=> $vendorAccId , 
            'VendAddress'=>$address,
            'CreateById' => $insertedBy ,
            'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
    }



    public function getAVendorRecordByVendorAutoId($vendorId){ 
        return Vendor::where('ActiveStatus',true)->where('VendId',$vendorId)->firstOrFail();
    }

}