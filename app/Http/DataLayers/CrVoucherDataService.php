<?php 

namespace App\Http\DataLayers;
 
use App\Http\DataLayers\DebitCreditDataService;
use App\Models\Transactions;
use App\Models\DebitCredit;
use App\Models\CrVoucher;
use App\Models\DrVoucher;

use Carbon\Carbon;

 
 class CrVoucherDataService{

  // all income invoice 
  public function insertCreditVoucher($amount,$receipt_number,$pay_method,$date,$inserted_by,$remarks){
      
            return  CrVoucher::insertGetId([
                'TransactionId'=>$transaction_id,
                'DrTypeId'=> 1 ,   
                'receipt_number'=>$receipt_number,
                'ReceivedDate'=>$date,
                'Amount'=>$amount,
                'DebitedTold'=>205,
                'CreditedFromId'=>210,
                'Remarks'=>$remarks,
                'CreateById'=>$inserted_by,
                'ReceiveMethod' => $pay_method,
                'created_at'=>Carbon::now(),
            ]);  
      return false;
  }

  public function insertNewCreditVoucherInformation($payAmount,$carryingBill,$discount,$labourBill,$purchaseDate,
  $vendorId,$paymentType,$doNo,$truckNo,$insertBy,$debitAccount,$creditAccount,$itemRecords ){
         // $creditAccount = 1;
         $transId =  (new DebitCreditDataService())->insertNewDebitCreditTransaction($debitAccount,$creditAccount, $payAmount,2,$purchaseDate);
         
         if($transId){
            return $this->insertCreditVoucher();                  
         }else{
            return false;
         }
         
  }


    public function searchDailyCachReceiveRecordsByDate($date){
        return  CrVoucher::where('ReceivedDate',$date)
               ->leftjoin('users', 'users.id', '=', 'cr_vouchers.CreateById')              
               ->get();     
    }
    public function searchDailyCashReceivedRecordByAutoId($DrVoucId ){
      return  CrVoucher::where('cr_vou_auto_id',$DrVoucId )->first();     
    }


    public function calculateDailyTransactionCurrentBalanceOfDate($date){
          $total_cash_in = CrVoucher::whereBetween('ReceivedDate',["2024-01-01",$date])->get()->sum('Amount');   
          $total_cash_out = DrVoucher::whereBetween('ExpenseDate',["2024-01-01",$date])->get()->sum('Amount'); 
         return $total_cash_in -   $total_cash_out; 
    }

    public function deleteDailyCashReceiveRecordByAutoId($DrVoucId,$transactionId ){
      // $this->searchDailyExpenseRecordsByAutoId($CrVoucId ); 
       $this->deleteTransactionRecord($transactionId);
      return CrVoucher::where('cr_vou_auto_id',$DrVoucId)->delete();  
      
    }

   

 }
