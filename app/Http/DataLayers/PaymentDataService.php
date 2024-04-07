<?php

namespace App\Http\DataLayers;

use App\Models\CustomerPayment;

class PaymentDataService{
 
 

   /*
    ========================================================================
    ========================  Data Report Section ==========================
    ========================================================================
   */
 
   public function getCustomerPaymentReceivedRecordsForDayClosingReport($date){
    return CustomerPayment::get();
 }





}