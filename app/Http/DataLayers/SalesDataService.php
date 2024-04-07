<?php

namespace  App\Http\DataLayers;

use App\Models\CustomerInfo;
use App\Models\ProductSell;
use App\Models\ProductSellRecord;
use Carbon\Carbon;

 
 class SalesDataService{


    public function insertNewSalesInformation($customerId,$transactionId,$totalAmount,$netAmount,$discountAmount,$dueAmount,$labourCost,$payAmount,$sellDate,$voucherNo,$transportCost,$createdBy){
                    
                // insert data in database
            return ProductSell::insertGetId([
                    'CreateById' => $createdBy,
                    'CarryingCost' => $transportCost,
                    'VoucharNo' => $voucherNo,
                    'SellingDate' => $sellDate,
                    'PaidAmount' => $payAmount,
                    'LabourCost' => $labourCost,
                    'DueAmount' => $dueAmount,
                    'Commission' => $discountAmount,
                    'NetAmount' => $netAmount,
                    'TotalAmount' => $totalAmount,
                    'TranId' => $transactionId,
                    'CustId' => $customerId,
                  //  'created_at' => Carbon::now(),
                ]);
    }















    /*
    ========================================================================
    ======================== Sales Item Records Section ====================
    ========================================================================
   */

    public function insertNewSaleItemRecord($sale_auto_id,$qty,$price,$unitLabourCost,$catId,$brandId,$sizeId,$thickId){
        ProductSellRecord::insert([
            'ProdSellId' => $sale_auto_id,
            'Quantity' => $qty,
            'Amount' => $price,
            'LabourCost' => $unitLabourCost == null ? 0 : $unitLabourCost ,
            'CateId' => $catId,
            'BranId' => $brandId,
            'SizeId' => $sizeId,
            'ThicId' => $thickId,
          ]);
    }








    /*
    ========================================================================
    ======================== Sales Report ====================
    ========================================================================
   */

    public function getSaleRecordsForDayClosingReport($date){
      return ProductSell::get();
   }



 } 
 