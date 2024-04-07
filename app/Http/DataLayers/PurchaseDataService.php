<?php

namespace App\Http\DataLayers;

use App\Http\DataLayers\DebitCreditDataService;
use App\Models\PurchaseRecord;
use App\Models\ProductPurchase;
class PurchaseDataService{


    public function insertNewPurchaseInformation($payAmount,$carryingBill,$discount,$labourBill,$purchaseDate,
    $vendorId,$paymentType,$doNo,$truckNo,$insertBy,$debitAccount,$creditAccount,$itemRecords ){


           // $creditAccount = 1;
           $transId =  (new DebitCreditDataService())->insertNewDebitCreditTransaction($debitAccount,$creditAccount, $payAmount,2,$purchaseDate);
           
           if($transId){
                    $purchaseId = ProductPurchase::insertGetId([
                        'TransactionId' => $transId,
                        'TotalPrice' => $payAmount,
                        'PurchaseDate' => $purchaseDate,
                        'VendorId' => $vendorId,
                        'LabourCost' => $labourBill,
                        'PaymentType' => 1,
                        'BankId' => 1,
                        'Discount' => $discount,
                        'CarringCost' => $carryingBill,
                        'DoNo' => $doNo ?? "",
                        'TruckNo' => $truckNo ?? "",
                        'CreateById' => $insertBy,
                    ]);
                    if($purchaseId){
                        $this->insertNewPurchaseItemRecords($itemRecords,$purchaseId);
                        return $purchaseId;
                    }else{
                        return false;
                    }
           }else{
                return false;
           }
           
    }






    public function insertNewPurchaseItemRecords($itemRecords,$purchaseId){
            foreach ($itemRecords as $data) {
                PurchaseRecord::insert([
                'Quantity' => $data->qty,
                'UnitPrice' => $data->price,
                'Amount' => $data->subtotal,
                'ProdPurcId' => $purchaseId,
                'CateId' => $data->options->CategoryId,
                'BranId' => $data->options->BranId,
                'SizeId' => $data->options->Size,
                'ThicId' => $data->options->Thickness,
                ]);

            //    $stockUpdate = $stockConObj->updateProductStockByCategoryBrandSizeThicknessId(
            //     $data->options->CategoryId,$data->options->BranId
            //     ,$data->options->Size,$data->options->Thickness,$data->qty); 

            }
    }

    public function getPurchaseRecordsForDayClosingReport($date){
       return ProductPurchase::get();
    }

}