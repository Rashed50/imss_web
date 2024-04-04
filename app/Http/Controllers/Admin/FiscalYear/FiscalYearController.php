<?php

 
namespace App\Http\Controllers\Admin\FiscalYear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\DataServices\FiscalYearDataService;
//use App\Http\Controllers\DataServices\SalaryProcessDataService;
//use App\Http\Controllers\DataServices\EmployeeDataService;
//use App\Http\Controllers\DataServices\EmployeeAdvanceDataService;


use App\Http\Controllers\Admin\Helper\HelperController;
use Carbon\Carbon;
use Exception;
 
use Illuminate\Support\Facades\Auth;


class FiscalYearController extends Controller
{
      
    function __construct()
    {       
         $this->middleware('permission:employee_fiscal_year_add', ['only' => ['index']]);
         $this->middleware('permission:employee_fiscal_year_search', ['only' => ['searchAnEmployeeOpenClosingAllRecords']]);       
    } 

    public function index(){
        return view('admin.fiscal_year.index');
    }   

    public function searchAnEmployeeOpenClosingAllRecords(Request $request){

         try{
            $records = (new FiscalYearDataService())->getAnEmployeeOpenCloseFiscalYearAllRecords($request->employee_searching_value);  
            return response()->json(['status'=>200,'success'=>true, 'data' => $records,'request_data'=>$request->all()]);

         }catch(Exception $ex){
            return response()->json(['status'=>603,'success'=>false, 'message'=>'Server Operation Failed','error' => $ex]); 
        }
    
    }
    public function searchAnEmployeeLastClosingFiscalRecord(Request $request){

          try{
              $employee = (new EmployeeDataService())->getAnEmployeeInfoByEmpId($request->employee_id);
              if($employee == null){
                return response()->json(['status'=>404,'success'=>false, 'message'=>'Employee Not Found','error' => 'error']); 
              }
              
              $isExistRunningYear = (new FiscalYearDataService())->checkAnEmployeeRunningFiscalYearIsAlreadyExist($employee->emp_auto_id);  
              if($isExistRunningYear){
                return response()->json(['status'=>603,'success'=>false, 'message'=>'The Employee Fiscal Year is Already Opened','error' => 'error']); 
              }
              else if((new FiscalYearDataService())->checkAnEmployeeFiscalYearIsAlreadyExist($employee->emp_auto_id)){
                $closed_record = (new FiscalYearDataService())->getAnEmployeeLastClosingFiscalYearRecord($employee->emp_auto_id); 
                return response()->json(['status'=>200,'success'=>false, 'data' => $closed_record,'employee'=>$employee]);
              }else {
                $isExistRunningYear = (new FiscalYearDataService())->getAnEmployeeRunningFiscalYearRecord($employee->emp_auto_id);  
                return response()->json(['status'=>603,'success'=>false, 'message'=>'The Employee Fiscal Year is Already Opened','error' => 'error']); 
              }             
  
          }catch(Exception $ex){
              return response()->json(['status'=>603,'success'=>false, 'message'=>'Server Operation Failed','error' => $ex]); 
          }
      
      }

    // Update Running   fiscal year Or Insert New Salary Fiscal Year
    public function updateAnEmployeeSalaryFiscalYear(Request $request){
      try{

        if($request->operation_type == 1 || $request->operation_type == 0 ){
            
          return response()->json(['success'=>true,'status'=>200,'message'=>'Successfully Update ','data'=>$request->all()]);
              $fiscal_record = (new FiscalYearDataService())->getAnEmployeeFiscalYearRecordByFiscalYearAutoId($request->fiscal_year_auto_id);
              $fiscal_record->end_date = $request->closing_date;//  $last_date_of_month;
              $fiscal_record->end_month = (new HelperController())->getMonthFromDateValue($request->closing_date);
              $fiscal_record->end_year = (new HelperController())->getYearFromDateValue($request->closing_date);         
              $fiscal_record->remarks =  $request->remarks;
              $fiscal_record->balance_amount =  $request->balance_amount;  
              $closing_status =  $request->operation_type;          
              $update = (new FiscalYearDataService())->updateAnEmployeeFiscalYear($fiscal_record->efcr_auto_id,$fiscal_record->emp_auto_id,$fiscal_record->end_month,
              $fiscal_record->end_year,$fiscal_record->end_date,$fiscal_record->balance_amount,$closing_status,$fiscal_record->remarks,Auth::user()->id);
              return response()->json(['success'=>true,'status'=>200,'message'=>'Successfully Update ']);
            
        }        
        else if($request->operation_type == 2){
                // open new fiscal year 
                if(!(new FiscalYearDataService())->checkAnEmployeeRunningFiscalYearIsAlreadyExist($request->emp_auto_id)){
                    $start_date = $request->closing_date;
                    $start_month = (new HelperController())->getMonthFromDateValue($start_date);
                    $start_year = (new HelperController())->getYearFromDateValue($start_date);
                    $fiscal_record = (new FiscalYearDataService())->setAnEmployeeFiscalYearDuration($request->emp_auto_id,$start_month,$start_year,$start_date,0,Auth::user()->id);                     
                    return response()->json(['success'=>true,'status'=>200,'message'=>'Successfully Update ']);
                  }else {
                    return response()->json(['success'=>true,'status'=>303,'message'=>'This Employee Fiscal Year Is Running ']);
                }
        }          
      }catch(Exception $ex){
          return response()->json(['success'=>true,'status'=>404,'message'=>'Operation Failed, Please Try Again','error'=>"error"]);
      }
    }
 

      // Searching Employee Fiscal Year Last Record (RUnning or CLosing )
    public function getAnEmployeeFiscalYearRecordByFiscalYearAutoIdForUpdate(Request $request){
      try{

          $fiscal = (new FiscalYearDataService())->getAnEmployeeFiscalYearRecordByFiscalYearAutoId($request->efcr_auto_id); 
          if($fiscal){  

            $employee = (new EmployeeDataService())->getAnEmployeeInformationWithAllReferenceTableByEmpAutoId($fiscal->emp_auto_id);             
            
            if( is_null($fiscal->end_date)){
              $fiscal->end_date =  date('Y-m-d');
            }
                          
            $totalUnPaidSalaryAmount = (new SalaryProcessDataService())->getAnEmployeeUnpaidSalaryTotalAmountByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
            // Advance Collection
            $toal_iqama_expense_deduction_from_salary = (new SalaryProcessDataService())->getAnEmployeeTotalAmountOfIqamaExpenseDeductionFromSalaryByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
            $total_other_advace_deduction_from_salary = (new SalaryProcessDataService())->getAnEmployeeTotalAmountOfOtherAdvanceDeductionFromSalaryByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
            $cashReceiveTotalPaidAmount =  (new EmployeeAdvanceDataService())->getAnEmployeeAdvancePaidByCachTotalAmountByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
            
            $closed_fiscal_record = (new FiscalYearDataService())->getAnEmployeeLastClosingFiscalYearRecord($employee->emp_auto_id);
            // Advance Give to Employee
            $iqamaRenewalTotalExpence = (new EmployeeAdvanceDataService())->getAnEmployeeIqamaRenewalTotalExpenseAmountByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
              $otherAdvanceTotalAmount = (new EmployeeAdvanceDataService())->getAnEmployeeOthersAdvanceGivenTotalAmountByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
              $toal_CPF_contribution_from_salary =  (new SalaryProcessDataService())->getAnEmployeeTotalAmountContributeToCPFByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
              $totalSaudiTax = (new SalaryProcessDataService())->getAnEmployeeTotalAmountSaudiTaxDeductionFromSalaryByFiscalYear($employee->emp_auto_id,$fiscal->start_date,$fiscal->end_date);
            //  $empl_last_activity = (new EmpActivityDataService())->getAnEmployeeLastActivityComments($employee->emp_auto_id);
              $bonus_records = (new SalaryProcessDataService())->getAnEmployeeBonusRecordByFiscalYear($employee->emp_auto_id, $fiscal->start_year,$fiscal->end_year);
                
              $info = [
                'previous_record' => $closed_fiscal_record,
                'unpaid_salary' =>$totalUnPaidSalaryAmount ,
                'iqama_deduction' =>$toal_iqama_expense_deduction_from_salary ,
                'other_deduction' =>$total_other_advace_deduction_from_salary,
                'cash_received' =>$cashReceiveTotalPaidAmount,
                'iqama_renew_expense' =>$iqamaRenewalTotalExpence,
                'other_advance' =>$otherAdvanceTotalAmount ,
                'cpf' =>$toal_CPF_contribution_from_salary,
                'saudi_tax' =>$totalSaudiTax ,
                'bonus_records' =>$bonus_records
              ];
                
              
              if($closed_fiscal_record->efcr_auto_id == $request->efcr_auto_id){
                $closed_fiscal_record->balance_amount = 0;
              }
              $fiscal->balance_amount =   ($iqamaRenewalTotalExpence + $otherAdvanceTotalAmount + $closed_fiscal_record->balance_amount) - ($toal_iqama_expense_deduction_from_salary +
                                  $total_other_advace_deduction_from_salary+$cashReceiveTotalPaidAmount + $totalUnPaidSalaryAmount);

              return response()->json(['success'=>true,'status'=>200,'message'=>'S','fiscal_record'=>$fiscal,'closing_amount'=>  $fiscal->balance_amount,'salary_closing_details'=>$info,'employee'=>$employee]);
            }else {
                return response()->json(['success'=>false,'status'=>404,'message'=>'Record Not Found','error'=>'error']);
            }

      }catch(Exception $ex){
            return response()->json(['success'=>true,'status'=>404,'message'=>'Operation Failed, Please Try Again','error'=>"error".$ex]);
      }
   
    }

    public function deleteAnEmployeeFiscalYear(Request $req){
      try{

          $arecord = (new FiscalYearDataService())->getAnEmployeeFiscalYearRecordByFiscalYearAutoId($req->efcr_auto_id); 
          if($arecord->closing_status == false){
            $employee = (new FiscalYearDataService())->deleteAnEmployeeFiscalYearRecordByFiscalYearAutoId($req->efcr_auto_id);      
            return response()->json(['success'=>true,'status'=>200,'message'=>'Successfully Deleted']);
          }else {
            return response()->json(['success'=>true,'status'=>404,'message'=>'This Fiscal Year is Already Closed','error'=>"error"]);
          }

      }catch(Exception $ex){
          return response()->json(['success'=>true,'status'=>404,'message'=>'Operation Failed, Please Try Again','error'=>"error".$ex]);
      }


    }
    


}
