<?php 

namespace App\Http\DataLayers;
 
use App\Models\Transactions;
use App\Models\DebitCredit;
use App\Models\CrVoucher;
use App\Models\DrVoucher;

use Carbon\Carbon;

 
 class DebitCreditDataService{ 
    
 

 public function createNewTransaction($amount,$date,$transaction_type){

        return Transactions::insertGetId([
            'TranAmount'=>$amount, 
            'TranDate'=> $date,
            'TranTypeId'=>$transaction_type,
          //  'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        
        
    }
    
    public function insertNewDebitCreditTransaction($debit_account,$credit_account, $amount,$tranType,$tranDate){
  
       $transactionId = $this->createNewTransaction($amount,$tranDate,$tranType);
       if($transactionId>0){
          $dr_cr_id[0] =  DebitCredit::insertGetId([
                'Amount'=> $amount, 
                'TranId'=> $transactionId, 
                'ChartOfAcctId'=>$debit_account,  
                'DrCrTypeId'=>1,  // debit 
            ]);

            $dr_cr_id[1]  = DebitCredit::insertGetId([
              'Amount'=> $amount, 
              'TranId'=> $transactionId, 
              'ChartOfAcctId'=>$credit_account,  
              'DrCrTypeId'=>2,  // credit
          ]);
          return $transactionId;
        }else 
        return -1;
         
    }

    public function deleteTransactionRecord($transaction_id){
  
      Transactions::where('TranId',$transaction_id)->delete();
      DebitCredit::where('TranId',$transaction_id)->delete();
      return true;
        
   }


   // all expense invoice
  // public function insertDailyExpenseInvoiceInformation($debit_by,$amount,$expense_type_id,$date,$remarks,$pay_type,$inserted_by){


  //       $transaction_id = $this->createNewTransaction($amount,$date,1);  // Expense
  //       if($transaction_id>0){
  //           $isSuccess = $this->insertNewDebitCreditTransaction(210,200,$amount,$transaction_id);  // 210 = chart of accout petty cash
  //           if($isSuccess){
  //             return  DrVoucher::insertGetId([
  //                 'TransactionId'=>$transaction_id,
  //                 'DrTypeId'=> $expense_type_id ,  
  //                 'ExpenseDate'=>$date,
  //                 'Amount'=>$amount,
  //                 'DebitedTold'=>210,
  //                 'CreditedFromId'=>200,
  //                 'debit_by' =>$debit_by,
  //                 'Remarks'=>$remarks,
  //                 'CreateById'=>$inserted_by,
  //                 'PaymentType' => $pay_type,
  //                 'created_at'=>Carbon::now(),                  
  //             ]);      
  //           }           
  //       }
  //       return false;
  // }

  // public function searchDailyExpenseRecordsByDate($date){
  //   return  DrVoucher::where('ExpenseDate',$date)
  //           ->leftjoin('users', 'users.id', '=', 'dr_vouchers.CreateById')
  //           ->leftjoin('employee_infos', 'employee_infos.emp_auto_id', '=', 'dr_vouchers.debit_by')
  //           ->leftjoin('cost_types', 'dr_vouchers.DrTypeId', '=', 'cost_types.cost_type_id')
  //           ->get();     
  // }

  // public function searchDailyExpenseRecordsByAutoId($CrVoucId ){

  //     return  DrVoucher::where('dr_vou_auto_id',$CrVoucId)->first();     
  // }

  // public function deleteDailyExpenseRecordsByAutoId($CrVoucId,$transactionId ){
  //      // $this->searchDailyExpenseRecordsByAutoId($CrVoucId ); 
  //      $this->deleteTransactionRecord($transactionId);
  //      return DrVoucher::where('dr_vou_auto_id',$CrVoucId)->delete();     
  // }
  
 
    // all income invoice 

  // public function insertDailyTransactionCashReceive($amount,$receipt_number,$pay_method,$date,$inserted_by,$remarks){


  //     $transaction_id = $this->createNewTransaction($amount,$date,2); // 2 = Income
  //     if($transaction_id>0){
  //         $isSuccess = $this->insertNewDebitCreditTransaction(200,210,$amount,$transaction_id);  // 200 = chart of accout petty cash
  //         if($isSuccess){
  //           return  CrVoucher::insertGetId([
  //               'TransactionId'=>$transaction_id,
  //               'DrTypeId'=> 1 ,   
  //               'receipt_number'=>$receipt_number,
  //               'ReceivedDate'=>$date,
  //               'Amount'=>$amount,
  //               'DebitedTold'=>205,
  //               'CreditedFromId'=>210,
  //               'Remarks'=>$remarks,
  //               'CreateById'=>$inserted_by,
  //               'ReceiveMethod' => $pay_method,
  //               'created_at'=>Carbon::now(),
  //           ]);      
  //         }           
  //     } // dr_vouchers
  //     return false;
  // }


  //   public function searchDailyCachReceiveRecordsByDate($date){
  //       return  CrVoucher::where('ReceivedDate',$date)
  //              ->leftjoin('users', 'users.id', '=', 'cr_vouchers.CreateById')              
  //              ->get();     
  //   }
  //   public function searchDailyCashReceivedRecordByAutoId($DrVoucId ){
  //     return  CrVoucher::where('cr_vou_auto_id',$DrVoucId )->first();     
  //   }


  //   public function calculateDailyTransactionCurrentBalanceOfDate($date){
  //         $total_cash_in = CrVoucher::whereBetween('ReceivedDate',["2024-01-01",$date])->get()->sum('Amount');   
  //         $total_cash_out = DrVoucher::whereBetween('ExpenseDate',["2024-01-01",$date])->get()->sum('Amount'); 
  //        return $total_cash_in -   $total_cash_out; 
  //   }

  //   public function deleteDailyCashReceiveRecordByAutoId($DrVoucId,$transactionId ){
  //     // $this->searchDailyExpenseRecordsByAutoId($CrVoucId ); 
  //      $this->deleteTransactionRecord($transactionId);
  //     return CrVoucher::where('cr_vou_auto_id',$DrVoucId)->delete();  
      
  //   }

   

 }
