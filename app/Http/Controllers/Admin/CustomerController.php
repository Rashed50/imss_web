<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\DistrictController;
use Illuminate\Http\Request;
use App\Models\CustomerInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\DivisionController;
use App\Models\CustomerPayment;
use App\Http\Controllers\Admin\ChartOfAccountController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\DebitCreditController;
use App\Http\Controllers\Admin\CustomerPaymentController;
use App\Models\CrType;
use App\Models\CustomerIntialDue;
use App\Models\District;
use App\Models\EmployeeInformation;
use App\Models\ProductSell;
use App\Models\ProductSellRecord;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as Image;


class CustomerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DATABASE OPERATION
    |--------------------------------------------------------------------------
    */
    public function getAllCustomer()
    {
        return $allCustomer = CustomerInfo::where('status', true)->orderBy('CustId', 'DESC')->get();
    }

    // public function getAllWholeseller(){
    //   return $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',1)->orderBy('CustId','DESC')->get();
    // }


    // public function getAllRetailer(){
    //   return $allCustomer = CustomerInfo::where('status',true)->where('CustTypeId',2)->orderBy('CustId','DESC')->get();
    // }


    public function getCustomer($id)
    {
        return $Customer = CustomerInfo::where('status', true)->where('CustId', $id)->first();
    }

    public function nameWiseFindCustomer($name, $number)
    {
        return $Customer = CustomerInfo::where('status', true)->where('ContactNumber', $number)->where('CustName', $name)->count();
    }


    public function getAllWholeCustomer()
    {
        return $allCustomer = CustomerInfo::where('status', true)->where('CustTypeId', 1)->get();
    }

    public function getRetailCustomer()
    {
        return $allCustomer = CustomerInfo::where('status', true)->where('CustTypeId', 2)->get();
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX METHOD CALLING 
    |--------------------------------------------------------------------------
    */


    // public function checkCustomerContact(Request $request){
    //    return $data = CustomerInfo::where('ContactNumber',$request->ContactNumber)->get();
    //    return json_encode($data);
    // }

    public function checkCustomerContact(Request $request)
    {
        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

        $allCustomer = $this->getAllCustomer();

        $customer = CustomerInfo::where('ContactNumber', $request->ContactNumber)->first();
        return response()->json(['customer' => $customer, 'allCustomer' => $allCustomer, 'Division' => $Division, 'allType' => $allType]);
    }

    public function holesellerCustomer()
    {
        $holeseller = CustomerInfo::where('CustTypeId', 1)->get();
        return json_encode($holeseller);
    }
    // Retailer Customer
    public function retailerCustomer()
    {
        $retailer = CustomerInfo::where('CustTypeId', 2)->get();
        return json_encode($retailer);
    }
    // Define Customer Due
    public function DefineCustomerDue(Request $request)
    {
        $customerDue = CustomerInfo::where('CustId', $request->Customer)->pluck('DueAmount');
        $salesReport = ProductSell::with('customer')->where('CustId', $request->Customer)->get();
        return response()->json(['customerDue' => $customerDue, 'salesReport' => $salesReport]);
    }


    public function sellIdWiseSaleRecord(Request $request)
    {
        $salesRecord = ProductSellRecord::with('category', 'size', 'thickness', 'brand')->where('ProdSellId', $request->ProdSellId)->get();
        return response()->json(['salesRecord' => $salesRecord]);
    }




    /* ++++++++++ Vouchar No ++++++++++ */
    public function vouchar()
    {
        $date = Carbon::now()->format('Ymd');
        $all = CustomerInfo::count();
        return $vouchar = "SEL-" . $date . '00' . $all;
    }


    public function CustIdWiseCustomerInformation(Request $request)
    {

        $allCustomer = $this->getCustomer($request->TradeName);
        return json_encode($allCustomer);
    }
    /* ++++++++++++ Ajax Route IN Customer Id Wise Customer information ++++++++++++ */







    /*
    |--------------------------------------------------------------------------
    | BALDE FILE OPERATION
    |--------------------------------------------------------------------------
    */

    // ========================= Custtomer list ===============================
    public function list()
    {
        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = $this->getAllWholeCustomer();
        return view('admin.customer.list.index', compact('allDistrict', 'allCustomer'));
    }


    public function searchSalesCustomer()
    {

        $TType = CrType::orderBy('CrTypeName', 'ASC')->get();
        $getAllEmployees = EmployeeInformation::orderBy('EmplInfoId', 'DESC')->get();

        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

        $allCustomer = $this->getAllCustomer();
        return view('admin.sell.search-sales', compact('allCustomer', 'getAllEmployees', 'TType'));
    }

    //  ==================== customer list for payment ======================
    public function listForPay()
    {

        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = $this->getAllWholeCustomer();
        return view('admin.customer.payment.search.index', compact('allDistrict', 'allCustomer'));
    }

    //  ==================== customer id wise sell details list  ======================
    public function customerTypewiseSellDetailsList()
    {

        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = $this->getAllWholeCustomer();
        return view('admin.sell.customer-sell', compact('allDistrict', 'allCustomer'));
    }

    public function searchlist()
    {
        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();
        return view('admin.customer.list.search', compact('allType'));
    }


    public function searchlistResult(Request $request)
    {
        $request->validate([
            'CustTypeId' => 'required',
            'searchCustomer' => 'required',
        ], [
            'CustTypeId.required' => 'please select customer type',
            'searchCustomer.required' => 'please input text'
        ]);
        $sResult = $request->searchCustomer;
        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();

        $allCustomer = CustomerInfo::where('CustTypeId', $request->CustTypeId)
            ->orWhere('CustName', 'like', "%{$request->searchCustomer}%")
            ->orWhere('TradeName', 'like', "%{$request->searchCustomer}%")
            ->orWhere('ContactNumber', 'like', "%{$request->searchCustomer}%")
            ->orWhere('Address', 'like', "%{$request->searchCustomer}%")
            ->get();
        return view('admin.customer.list.search-result', compact('allCustomer', 'allType', 'sResult'));
    }

    public function search(Request $request)
    {

        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status', true)->where('CustTypeId', $request->type)
            ->orWhere('DistId', $request->DistId)->orWhere('ThanId', $request->ThanId)->get();

        return view('admin.customer.list.index', compact('allDistrict', 'allCustomer'));
    }

    public function searchForPay(Request $request)
    {
        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status', true)->where('CustTypeId', $request->type)
            ->orWhere('DistId', $request->DistId)->orWhere('ThanId', $request->ThanId)->get();

        return view('admin.customer.payment.search.index', compact('allDistrict', 'allCustomer'));
    }


    public function searchCustomerTypewiseSellDetailsList(Request $request)
    {

        $districeOBJ = new DistrictController();
        $allDistrict = $districeOBJ->getAllDistrictsByDivisionId(1);

        $allCustomer = CustomerInfo::where('status', true)->where('CustTypeId', $request->type)
            ->orWhere('DistId', $request->DistId)->orWhere('ThanId', $request->ThanId)->get();

        return view('admin.sell.customer-sell', compact('allDistrict', 'allCustomer'));
    }



    public function add()
    {
        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

        $allCustomer = $this->getAllCustomer();
        return view('admin.customer.add', compact('allCustomer', 'Division', 'allType'));
    }

    public function edit($id)
    {
        $typeObj = new CustomerTypeController;
        $allType = $typeObj->getAll();

        $DivisionOBJ = new DivisionController();
        $Division = $DivisionOBJ->getAll();

        $allCustomer = $this->getAllCustomer();

        $data = $this->getCustomer($id);
        return view('admin.customer.add', compact('data', 'allCustomer', 'Division', 'allType'));
    }





    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'CustName'=>'required|max:50',
        //     'TradeName'=>'required|max:50',
        //     'ContactNumber'=>'required|max:20',
        //     'Address'=>'required|max:200',
        //     'DueAmount'=>'required|max:20',
        //     'InitialDue'=>'required|max:20',
        //     'FatherName'=>'required|max:50',
        //     'NID'=>'required|max:30',
        // ],[
        //     'CateName.required'=> 'please enter customer name',
        //     'CateName.max'=> 'max customer name content is 200 character',
        // ]);

        //  dd($request);

        $creator = Auth::user()->id;
        $insert = CustomerInfo::insertGetId([
            'CustName' => $request['CustName'],
            'TradeName' => $request['TradeName'],
            'CustTypeId' => $request['CustTypeId'],
            'ContactNumber' => $request['ContactNumber'],
            'Address' => $request['Address'],
            'DueAmount' => $request['InitialDue'],
            'InitialDue' => $request['InitialDue'],
            'FatherName' => $request['FatherName'],
            'NID' => $request['NID'],
            'Photo' => '',
            'CreateById' => $creator,
            "DiviId" => $request['DiviId'],
            "DistId" => $request['DistId'],
            "ThanId" => $request['ThanId'],
            "UnioId" => $request['UnioId'],
            // 'created_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);


        $dataInit['DueAmount'] = $request->InitialDue;
        $dataInit['Year'] = Carbon::now()->format('Y');
        $dataInit['EntryDate'] = Carbon::now();
        $dataInit['CustId'] = $insert;
        $dataInit['CreateById'] = Auth::user()->id;
        $dataInit['created_at'] = Carbon::now();

        CustomerIntialDue::create($dataInit);



        if ($request->hasFile('Photo')) {
            $image = $request->file('Photo');
            $imageName = 'customer_' . $request->CustName . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('uploads/customer/' . $imageName);
            $saveurl = 'uploads/customer/' . $imageName;

            CustomerInfo::where('CustId', $insert)->update([
                'Photo' => $saveurl,
            ]);
        }

        if ($insert) {
            Session::flash('success', 'new customer add Successfully.');
            return redirect()->route('customer.add');
        } else {
            Session::flash('error', 'please try again.');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $id = $request->CustId;
       
        $this->validate($request, [
            'CustName' => 'required|max:50',
            'TradeName' => 'required|max:50',
            'ContactNumber' => 'required|max:20',
            'Address' => 'required|max:200',
            'InitialDue' => 'required|max:20',
            'FatherName' => 'required|max:50',
            'NID' => 'required|max:30',
        ], [
            'CateName.required' => 'please enter customer name',
            'CateName.max' => 'max customer name content is 200 character',
        ]);
      


        $insert = CustomerInfo::where('status', true)->where('CustId', $id)->update([
            'CustName' => $request['CustName'],
            'TradeName' => $request['TradeName'],
            'ContactNumber' => $request['ContactNumber'],
            'Address' => $request['Address'],
            'InitialDue' => $request['InitialDue'],
            'FatherName' => $request['FatherName'],
            'NID' => $request['NID'],
            // 'updated_at'=>Carbon::now('Asia/Dhaka')->toDateTimeString(),
        ]);

        if ($request->hasFile('Photo')) {
            $image = $request->file('Photo');
            $imageName = 'customer_' . $request->CustName . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 200)->save('uploads/customer/' . $imageName);

            CustomerInfo::where('CustId', $id)->update([
                'Photo' => $imageName,
            ]);
        }

        if ($insert) {
            Session::flash('success', 'customer information updated Successfully.');
            return redirect()->route('customer.add');
        } else {
            Session::flash('error', 'please try again.');
            return redirect()->back();
        }
    }

    public function delete($id){
        $delete=CustomerInfo::where('status',true)->where('CustId',$id)->delete();
        if($delete){
            Session::flash('delete','Customer Information Delete Successfully.');
            return redirect()->route('customer.add');
        }else{
            Session::flash('error','please try again');
            return redirect()->back();
        }
    }


    // Wholeseller customer
    public function updateCustomerBalance($customerId, $amount)
    {
        $aCust = $this->getCustomer($customerId);
        $aCust->DueAmount = $aCust->DueAmount + $amount;

        $aCust = CustomerInfo::where('CustId', $customerId)->update([
            'DueAmount' => $aCust->DueAmount,
        ]);
    }

    // 
    public function updateRetailerCustomerBalance($customerId, $amount, $customerName, $cusTrade, $phone, $address)
    {

        if ($customerId != null) {
            $aCust = $this->getCustomer($customerId);
            $aCust->DueAmount = $aCust->DueAmount + $amount;

            return  $aCust = CustomerInfo::where('CustId', $customerId)->update([
                'DueAmount' => $aCust->DueAmount,
            ]);
        } else {
            $creator = Auth::user()->id;
            return  $insert = CustomerInfo::insertGetId([
                'CustName' => $customerName,
                'TradeName' => $cusTrade,
                'CustTypeId' => 2,
                'ContactNumber' => $phone,
                'Address' => $address,
                'DueAmount' => $amount,
                'InitialDue' => $amount,
                'FatherName' => '',
                'NID' => '',
                'Photo' => '',
                'CreateById' => $creator,
                "DiviId" => 1,
                "DistId" => 1,
                "ThanId" => 1,
                "UnioId" => 1,
                'created_at' => Carbon::now('Asia/Dhaka')->toDateTimeString(),
            ]);
        }
    }
}
