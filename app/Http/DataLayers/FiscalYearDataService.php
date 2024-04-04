<?php

namespace App\Http\Controllers\DataServices;

use App\Models\EmployeeFiscalYearDuration;
use Carbon\Carbon;
 
class FiscalYearDataService{

        
    /*
     =====================================================================================
     ======================= Employee Fiscal Year Section ================================
     =====================================================================================
    */

    public function checkAnEmployeeFiscalYearIsAlreadyExist($emp_auto_id){
        
        return EmployeeFiscalYearDuration::where('emp_auto_id',$emp_auto_id)->count() >= 1 ? true : false;
     }
     public function checkAnEmployeeRunningFiscalYearIsAlreadyExist($emp_auto_id){
         return EmployeeFiscalYearDuration::where('emp_auto_id',$emp_auto_id)->where('closing_status',false)->count() >= 1 ? true : false;
     }

     public function deleteAnEmployeeFiscalYearRecordByFiscalYearAutoId($efcr_auto_id){
        return EmployeeFiscalYearDuration::where('efcr_auto_id',$efcr_auto_id)->delete();    
    }

     public function getAnEmployeeOpenCloseFiscalYearAllRecords($employee_id){
         return EmployeeFiscalYearDuration::where('employee_infos.employee_id',$employee_id)
                         ->leftjoin('employee_infos', 'employee_fiscal_closing_records.emp_auto_id', '=', 'employee_infos.emp_auto_id')->get();                       
         
     } 
     public function getAnEmployeeRunningFiscalYearRecord($emp_auto_id){
 
        if(!$this->checkAnEmployeeFiscalYearIsAlreadyExist($emp_auto_id)){
            $this->setAnEmployeeFiscalYearDuration($emp_auto_id,1,2021,'2021-12-31',0,2);
         }

         $record = EmployeeFiscalYearDuration::where('emp_auto_id',$emp_auto_id)
                         ->where('closing_status',false)
                         ->latest('efcr_auto_id')
                         ->first();
                        
         if(is_null($record)){
             $record = EmployeeFiscalYearDuration::make();   // create object
             $record->balance_amount = 0.0;  
 
             $record->start_year = (int) Carbon::now()->format('Y');
             $record->start_month = (int) Carbon::now()->format('m');
             $record->start_date =  Carbon::now()->format('Y-m-d');             
         }
         $record->end_year = (int) Carbon::now()->format('Y');
         $record->end_month = (int) Carbon::now()->format('m');
         $record->end_date =  Carbon::now()->format('Y-m-d');
         return $record;
     }
 
     public function getAnEmployeeLastClosingFiscalYearRecord($emp_auto_id){
 
         $record = EmployeeFiscalYearDuration::where('emp_auto_id',$emp_auto_id)
                         ->where('closing_status',true)
                         ->latest('efcr_auto_id')
                         ->first();
                        
         if(is_null($record)){
             $record = EmployeeFiscalYearDuration::make();   // create object
             $record->balance_amount = 0.0;
         }
         return $record;
     } 

     public function getAnEmployeeFiscalYearRecordByFiscalYearAutoId($efcr_auto_id){
         return EmployeeFiscalYearDuration::where('efcr_auto_id',$efcr_auto_id)->first();    
     }
 
     public function updateAnEmployeeFiscalYear($emp_fis_year_auto_id,$emp_auto_id,$end_month,$end_year,$end_date,$balance_amount,$closing_status ,$remarks,$updated_by){
 
      return  EmployeeFiscalYearDuration::where('efcr_auto_id',$emp_fis_year_auto_id)->where('emp_auto_id',$emp_auto_id)->update([            
             'end_month' =>$end_month,
             'end_year' =>$end_year,
             'end_date' =>$end_date,
             'balance_amount' =>$balance_amount,
             'closing_status' => $closing_status ,
             'remarks' =>$remarks,
             'updated_by' =>$updated_by,
         ]);
     }
 
     public function updateAnEmployeeFiscalYearClosingBalanceOnly($emp_fis_year_auto_id,$balance_amount){
 
         return  EmployeeFiscalYearDuration::where('efcr_auto_id',$emp_fis_year_auto_id)->update([            
                'balance_amount' =>$balance_amount
            ]);
        }
 
   
     public function setAnEmployeeFiscalYearDuration($emp_auto_id,$start_month,$start_year,$start_date,$balance_amount,$created_by){
 
       return  $autoId =   EmployeeFiscalYearDuration::insertGetId([
             'emp_auto_id' =>$emp_auto_id,
             'start_month' =>$start_month,
             'start_year' =>$start_year,
             'start_date' =>$start_date,
             'balance_amount' =>$balance_amount,
             'created_by' =>$created_by,
         ]);
        
     }
 
     public function checkThisOperationIsAllowInTheRunningFiscalYear($emp_auto_id,$operation_date){

        if(!$this->checkAnEmployeeFiscalYearIsAlreadyExist($emp_auto_id)){
            $this->setAnEmployeeFiscalYearDuration($emp_auto_id,1,2021,'2021-12-31',0,2);
         }
         $record = EmployeeFiscalYearDuration::where('emp_auto_id',$emp_auto_id)
                         ->where('closing_status',false)
                         ->latest('efcr_auto_id')
                         ->first();
         if($record == null){
             return false;
         }
         if( $record->start_date <= $operation_date)
              return true;
         else
            return false;
      }
 



}
