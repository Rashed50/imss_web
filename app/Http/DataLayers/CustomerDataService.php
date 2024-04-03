<?php

namespace App\Http\DataLayers;

use App\Models\CustomerInfo;

class CustomerDataService{



    function insertNewCustomerInformation($custName,$custNameBl,$tradeName,$tradeNameBl,$cusTypeId,$contactNo,
    $address,$initialDue,$fatherName,$nid,$photoPath,$divId,$distId,$thanaId,$unionId,$createById){
        return CustomerInfo::insertGetId([
            'CustName' => $custName,
            'CustNameBl' => $custNameBl,
            'TradeName' => $tradeName,
            'TradeNameBl' => $tradeNameBl,
            'CustTypeId' => $cusTypeId,  // 1 = whole Seller, 2= Reseller
            'ContactNumber' => $contactNo,
            'Address' => $address,
            'DueAmount' => $initialDue,
            'InitialDue' => $initialDue,
            'FatherName' =>$fatherName,
            'NID' => $nid,
            'Photo' => $photoPath,
            'CreateById' => $createById,
            "DiviId" => $divId,
            "DistId" => $distId,
            "ThanId" => $thanaId,
            "UnioId" => $unionId,
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
    }

    function insertNewCustomerWithMinimumInformation($custName,$contactNo,$dueAmount,$cusTypeId,
    $address,$createById){
        return CustomerInfo::insertGetId([
            'CustName' => $custName,
            'CustNameBl' => "",
            'TradeName' => $custName,
            'TradeNameBl' => "",
            'CustTypeId' => $cusTypeId, // 1 = whole Seller, 2= Reseller
            'ContactNumber' => $contactNo,
            'Address' => $address,
            'DueAmount' => $dueAmount,
            'InitialDue' => $dueAmount,
            'FatherName' =>"",
            'NID' => "",
            'Photo' => "",
            'CreateById' =>$createById,
            "DiviId" => 1,
            "DistId" => 1,
            "ThanId" => 1,
            "UnioId" => 1,
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);
    }

   /*
    ========================================================================
    ========================  Data Retriving Section =======================
    ========================================================================
   */

    public function getAllCustomer()
    {
        return CustomerInfo::where('status', true)->orderBy('CustId', 'DESC')->get();
    }
 
    public function searchACustomerByCustomerAutoId($id)
    {
        return $Customer = CustomerInfo::where('status', true)->where('CustId', $id)->first();
    }
    public function searchACustomerByPhoneNumber($ContactNo)
    {
        return  CustomerInfo::where('status', true)->where('ContactNumber', $ContactNo)->first();
    }

    
    public function searchNumberOfCustomerByNameAndPhoneNumber($name, $number)
    {
        return $Customer = CustomerInfo::where('status', true)->where('ContactNumber', $number)->where('CustName', $name)->count();
    }


    public function retriveAllWholeSaleCustomers()
    {
        return CustomerInfo::where('status', true)->where('CustTypeId', 1)->get();
    }

    public function retriveAllRetaileCustomers()
    {
        return CustomerInfo::where('status', true)->where('CustTypeId', 2)->get();
    }








}