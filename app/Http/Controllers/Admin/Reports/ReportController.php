<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\DataLayers\CompanyDataService;
use App\Http\DataLayers\CustomerDataService;
use App\Http\DataLayers\PurchaseDataService;
use App\Http\DataLayers\SalesDataService;
use App\Http\DataLayers\PaymentDataService;
//use App\Http\DataLayers\SalesDataService;
//use App\Http\DataLayers\SalesDataService;
//use App\Http\DataLayers\SalesDataService;




class ReportController extends Controller{


    public function loadReportDasboard(){
        return view("admin.reports.report_processing_form");
    }


    public function getActiveCustomerReport(Request $request){

       // dd($request->all());
    //    "customer_type" => "1"
    //    "due_amount" => null
    //    "report_type" => "1"
        $customers = (new CustomerDataService())->getAllCustomer();
        $company = (new CompanyDataService())->getCompanyProfileInformation();
     //   dd($customers);
        return view("admin.reports.customer.active_customer_list",compact("customers","company"));
       
       
    }

    public function processDayClosingReport(Request $request){

        // dd($request->all());
     //    "customer_type" => "1"
     //    "due_amount" => null
     //    "report_type" => "1"
         $customers = (new CustomerDataService())->getAllCustomer();

         $purchaseRecords = (new PurchaseDataService())->getPurchaseRecordsForDayClosingReport($request->date);
         $salesRecords = (new SalesDataService())->getSaleRecordsForDayClosingReport($request->date);
         $customerPaymentRecords = (new SalesDataService())->getCustomerPaymentReceivedRecordsForDayClosingReport($request->date);

         $company = (new CompanyDataService())->getCompanyProfileInformation();
         //   dd($customers);
         return view("admin.reports.customer.active_customer_list",compact("purchaseRecords","salesRecords","customerPaymentRecords","company"));
        
        
     }


    

}