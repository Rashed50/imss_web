@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->

  <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('product.purchase.update') : route('product.purchase.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} customer Information</h3>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card-body card_form">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    @if(Session::has('success'))
                    <div class="alert alert-success alertsuccess" role="alert">
                        <strong>Success!</strong> {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger alerterror" role="alert">
                        <strong>Opps!</strong> {{Session::get('error')}}
                    </div>
                    @endif
                </div>
                <div class="col-md-2"></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row custom_form_group{{ $errors->has('TransactionId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Transaction Id:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Transaction Id" class="form-control" id="TransactionId" name="TransactionId" value="{{(@$data)?@$data->TransactionId:old('TransactionId')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('TransactionId'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('TransactionId') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                     <div class="form-group row custom_form_group{{ $errors->has('PurchaseDate') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Purchase Date:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Purchase Date" class="form-control" id="PurchaseDate" name="PurchaseDate" value="{{(@$data)?@$data->PurchaseDate:old('PurchaseDate')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('PurchaseDate'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('PurchaseDate') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('TotalPrice') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Total Price:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Total Price" class="form-control" id="TotalPrice" name="TotalPrice" value="{{(@$data)?@$data->TotalPrice:old('TotalPrice')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('TotalPrice'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('TotalPrice') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Discount:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Discount" class="form-control" id="Discount" name="Discount" value="{{(@$data)?@$data->Discount:old('Discount')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('Discount'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Discount') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                     <div class="form-group row custom_form_group{{ $errors->has('CarringCost') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Carring Cost:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Carring Cost" class="form-control" id="CarringCost" name="CarringCost" value="{{(@$data)?@$data->CarringCost:old('CarringCost')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('CarringCost'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CarringCost') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                     
                       <div class="form-group row custom_form_group{{ $errors->has('LabourCost') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Labour Cost:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Labour Cost" class="form-control" id="LabourCost" name="LabourCost" value="{{(@$data)?@$data->LabourCost:old('LabourCost')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('LabourCost'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('LabourCost') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                     <div class="form-group row custom_form_group{{ $errors->has('BankId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Bank Id:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Bank Id" class="form-control" id="BankId" name="BankId" value="{{(@$data)?@$data->BankId:old('BankId')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('BankId'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('BankId') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    





                </div>

                {{--  2nd col-md-6 start  --}}
                <div class="col-md-6">
                    
                    <div class="form-group row custom_form_group{{ $errors->has('VendorId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Vendor Name:</span></label>
                        <div class="col-sm-7">
                        <select class="form-control" name="VendorId" id="VendorId">
                            <option value="">Select Vendor</option>
                            <option value="1">Wholesaler</option>
                            <option value="2">Retailer</option>
                        </select>
                        @if ($errors->has('VendorId'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('VendorId') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>  
                    <div class="form-group row custom_form_group{{ $errors->has('StaffId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Staff Name:</span></label>
                        <div class="col-sm-7">
                        <select class="form-control" name="StaffId" id="StaffId">
                            <option value="">Select Staff</option>
                            <option value="1">Wholesaler</option>
                            <option value="2">Retailer</option>
                        </select>
                        @if ($errors->has('StaffId'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('StaffId') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                      <div class="form-group row custom_form_group{{ $errors->has('PaymentType') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Payment Type:</span></label>
                        <div class="col-sm-7">
                        <select class="form-control" name="PaymentType" id="PaymentType">
                            <option value="">Select Payment Type</option>
                            <option value="1">Wholesaler</option>
                            <option value="2">Retailer</option>
                        </select>
                        @if ($errors->has('PaymentType'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('PaymentType') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div> 
                    <div class="form-group row custom_form_group{{ $errors->has('ToSaleId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">To Sale Id:</span></label>
                        <div class="col-sm-7">
                        <select class="form-control" name="ToSaleId" id="ToSaleId">
                            <option value="">Select To Sale Id</option>
                            <option value="1">Wholesaler</option>
                            <option value="2">Retailer</option>
                        </select>
                        @if ($errors->has('ToSaleId'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ToSaleId') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('TruckNo') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Truck No:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Truck No" class="form-control" id="TruckNo" name="TruckNo" value="{{(@$data)?@$data->TruckNo:old('TruckNo')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('TruckNo'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('TruckNo') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div> 
                    <div class="form-group row custom_form_group{{ $errors->has('DoNo') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Do No:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Do No" class="form-control" id="DoNo" name="DoNo" value="{{(@$data)?@$data->DoNo:old('DoNo')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('DoNo'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('DoNo') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    
                    <!-- <div class="form-group row custom_form_group{{ $errors->has('Photo') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Photo :</span></label>
                        <div class="col-sm-5">
                        <input type="file" id="image" class="form-control" id="Photo" name="Photo">
                        @if ($errors->has('Photo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Photo') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="pl-2">
                            <img id="showImage" height="70" alt="">
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

        <div class="card-footer card_footer_button text-center">
            <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">{{ (@$data)?'UPDATE':'SUBMIT' }}</button>
        </div>
    </div>
  </form>
    <!-- list -->
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>customer List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            @if(Session::has('success_soft'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> delete customer information.
                              </div>
                            @endif

                            @if(Session::has('success_update'))
                              <div class="alert alert-success alertsuccess" role="alert">
                                 <strong>Successfully!</strong> update customer information.
                              </div>
                            @endif

                            @if(Session::has('error'))
                              <div class="alert alert-warning alerterror" role="alert">
                                 <strong>Opps!</strong> please try again.
                              </div>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                <table id="datatable1" class="table table-bordered responsive mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Transaction Id</th>
                                            <th>Total Price</th>
                                            <th>Purchase Date</th>
                                            <th>Vendor Id</th>
                                            <th>Staff Id</th>
                                            <th>Labour Cost</th>
                                            <th>Payment Type</th>
                                            <th>Bank Id</th>
                                            <th>Discount</th>
                                            <th>Carring Cost</th>
                                            <th>ToSaleId</th>
                                            <th>Do No</th>
                                            <th>Truck No</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($purchaseProduct as $key=>$purchase)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $purchase->TransactionId ??'' }}</td>
                                            <td>{{ $purchase->TotalPrice ??'' }}</td>
                                            <td>{{ $purchase->PurchaseDate ??'' }}</td>
                                            <td>{{ $purchase->VendorId ??'' }}</td>
                                            <td>{{ $purchase->StaffId ??'' }}</td>
                                            <td>{{ $purchase->LabourCost ??'' }}</td>
                                            <td>{{ $purchase->PaymentType ??'' }}</td>
                                            <td>{{ $purchase->BankId ??'' }}</td>
                                            <td>{{ $purchase->Discount ??'' }}</td>
                                            <td>{{ $purchase->CarringCost ??'' }}</td>
                                            <td>{{ $purchase->ToSaleId ??'' }}</td>
                                            <td>{{ $purchase->DoNo ??'' }}</td>
                                            <td>{{ $purchase->TruckNo ??'' }}</td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('product.purchase.edit',$purchase->CustId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
                                                <a href="#" title="delete" id="delete"><i class="fa fa-trash fa-lg delete_icon"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end list -->
  </div>
  <!-- sl-pagebody -->
@endsection
