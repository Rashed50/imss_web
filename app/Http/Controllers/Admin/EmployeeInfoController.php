<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\DivisionController;
use Illuminate\Http\Request;
use App\Models\EmployeeInformation;
use Carbon\Carbon;
use Image;
use Auth;

class EmployeeInfoController extends Controller{
  /*
  |--------------------------------------------------------------------------
  |  DATABASE OPERATION
  |--------------------------------------------------------------------------
  */

  public function getAllEmployees(){
    return $all = EmployeeInformation::orderBy('EmplInfoId','DESC')->get();
  }

  public function getEmployeeById($id){
    return $edit = EmployeeInformation::where('EmplInfoId',$id)->first();
  }




  /* ============== insert Employee Information in DATABASE ============== */

  public function store(Request $request){
    $this->validate($request,[
      'emp_name' => 'required'
    ],[
      'emp_name.required' => 'please enter employee name!',
    ]);
    /* ++++++++++++++ Making Image ++++++++++++++ */
    $photo = $request->file('profile_photo');
    $photoName = 'Emp-profile-image-'.time().'.'.$photo->getClientOriginalExtension();
    Image::make($photo)->resize(300,300)->save('uploads/employee/'.$photoName);
    $save_url = 'uploads/employee/'.$photoName;
    /* ++++++++++++++ Making Image ++++++++++++++ */

    $creator = Auth::user()->id;
    /* data insert */
    $insert = EmployeeInformation::insert([
      'Name' => $request->emp_name,
      'DesignationId' => $request->designation_id,
      'ContactNumber' => $request->mobile_no,
      'Village' => $request->Village,
      'FatherName' => $request->FatherName,
      'JoinDate' => $request->joining_date,
      'PostOffice' => $request->PostOffice,
      'DiviId' => $request->DiviId,
      'DistId' => $request->DistId,
      'ThanId' => $request->ThanId,
      'UnioId' => $request->UnioId,
      'Photo' => $save_url,
      'created_at' => Carbon::now(),
    ]);
    // Redirect Back
    if($insert){
      $notification=array(
          'message'=>'Successfully Store Employee Information',
          'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
    }
  }

  /* ============== update Employee Information in DATABASE ============== */
  public function update(Request $request){


    dd($request->all());
    $this->validate($request,[
      'emp_name' => 'required'
    ],[
      'emp_name.required' => 'please enter employee name!',
    ]);
    $creator = Auth::user()->id;
    if($request->profile_photo == ""){
      /* data insert */
      $update = EmployeeInformation::where('EmplInfoId',$request->id)->update([
        'Name' => $request->emp_name,
        'DesignationId' => $request->designation_id,
        'ContactNumber' => $request->mobile_no,
        'Village' => $request->Village,
        'FatherName' => $request->FatherName,
        'JoinDate' => $request->joining_date,
        'PostOffice' => $request->PostOffice,
        'DiviId' => $request->DiviId,
        'DistId' => $request->DistId,
        'ThanId' => $request->ThanId,
        'UnioId' => $request->UnioId,
        'updated_at' => Carbon::now(),
      ]);
    }else{
      if($request->oldPhoto !=""){
        unlink($request->oldPhoto);
      }
      /* ++++++++++++++ Making Image ++++++++++++++ */
      $photo = $request->file('profile_photo');
      $photoName = 'Emp-profile-image-'.time().'.'.$photo->getClientOriginalExtension();
      Image::make($photo)->resize(300,300)->save('uploads/employee/'.$photoName);
      $save_url = 'uploads/employee/'.$photoName;
      /* ++++++++++++++ Making Image ++++++++++++++ */
      /* data insert */
      $update = EmployeeInformation::where('EmplInfoId',$request->id)->update([
        'Name' => $request->emp_name,
        'DesignationId' => $request->designation_id,
        'ContactNumber' => $request->mobile_no,
        'Village' => $request->Village,
        'FatherName' => $request->FatherName,
        'JoinDate' => $request->joining_date,
        'PostOffice' => $request->PostOffice,
        'Photo' => $save_url,
        'DiviId' => $request->DiviId,
        'DistId' => $request->DistId,
        'ThanId' => $request->ThanId,
        'UnioId' => $request->UnioId,
        'updated_at' => Carbon::now(),
      ]);
    }



    // Redirect Back
    if($update){
      $notification=array(
          'message'=>'Successfully Update Employee Information',
          'alert-type'=>'success'
      );
      return Redirect()->route('employee.add')->with($notification);
    }
  }




  /*
  |--------------------------------------------------------------------------
  |  BLADE OPERATION
  |--------------------------------------------------------------------------
  */

  public function add(){
    // Call Division
    $DivisionOBJ = new DivisionController();
    $Division = $DivisionOBJ->getAll();
    // getAllEmployees
    $getAllEmployees = $this->getAllEmployees();
    return view('admin.employee-info.add',compact('Division','getAllEmployees'));
  }

  public function edit($id){
    // Call Division
    $DivisionOBJ = new DivisionController();
    $Division = $DivisionOBJ->getAll();
    // Find Employees
    $data = $this->getEmployeeById($id);
    return view('admin.employee-info.edit',compact('Division','data'));
  }




  /*
  |--------------------------------------------------------------------------
  |  API OPERATION
  |--------------------------------------------------------------------------
  */







  /* ======== end class bracket ======== */
}
