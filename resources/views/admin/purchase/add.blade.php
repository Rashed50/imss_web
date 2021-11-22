@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <div class="sl-pagebody">
    {{-- Response Massage --}}
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
    {{-- Response Massage --}}
    <div class="card">
        <div class="card-body card_form">
            <div class="row">
                <div class="col-md-4">

                    <div class="form-group row custom_form_group{{ $errors->has('CategoryID') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Category:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="CategoryID">
                            <option value="">Select Category</option>
                            @foreach ($allCatg as $data)
                              <option value="{{ $data->CateId }}">{{ $data->CateName }}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('CategoryID'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CategoryID') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('BranId') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Brand:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="BranId">
                            <option value="">Select Brand</option>
                          </select>
                          @if ($errors->has('BranId'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('BranId') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Size') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Size:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="Size">
                            <option value="">Select Size</option>
                          </select>
                          @if ($errors->has('Size'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Size') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Thickness') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Thickness:<span class="req_star">*</span></label>
                        <div class="col-sm-8">

                          <select class="form-control" name="Thickness">
                            <option value="">Select Thickness</option>
                          </select>
                          @if ($errors->has('Thickness'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Thickness') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('UnitPrice') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Unit Price:<span class="req_star">*</span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="UnitPrice" value="{{ old('UnitPrice') }}" placeholder="Input Amount">
                          @if ($errors->has('UnitPrice'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('UnitPrice') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('Qunatity') ? ' has-error' : '' }}">
                        <label class="col-sm-4 control-label">Qunatity:<span class="req_star">*</span></label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" name="Qunatity" value="{{ old('Qunatity') }}" placeholder="">
                          @if ($errors->has('Qunatity'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('Qunatity') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-primary waves-effect" onclick="addToCart()">Add To Cart</button>
                        </div>
                    </div>
                </div>

                {{-- Second Part --}}

                <div class="col-md-8">
                    <div class="SecondPart">
                      <form action="{{ route('product.purchase.store') }}" method="post">
                        @csrf

                        <div class="row">
                            {{-- First Item --}}
                            <div class="col-md-6">
                                <div class="form-group row custom_form_group{{ $errors->has('NetAmount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Net Amount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="NetAmount" name="NetAmount" value="{{ old('NetAmount') }}" required>
                                        @if ($errors->has('NetAmount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('NetAmount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('LabourCost') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Labour Cost:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="LabourCost" name="LabourCost" value="{{ old('LabourCost') }}" required>
                                        @if ($errors->has('LabourCost'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('LabourCost') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('CarryingBill') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Carrying Bill:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="CarryingBill" name="CarryingBill" value="{{ old('CarryingBill') }}" required>
                                        @if ($errors->has('CarryingBill'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('CarryingBill') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Discount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="Discount" name="Discount" value="{{ old('Discount') }}" required>
                                        @if ($errors->has('Discount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Discount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('PayAmount') ? ' has-error' : '' }}">
                                    <label class="col-sm-6 control-label">Pay PayAmount:<span class="req_star">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Input Amount" class="form-control" id="PayAmount" name="PayAmount" value="{{ old('PayAmount') }}" required>
                                        @if ($errors->has('PayAmount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('PayAmount') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>



                            </div>
                            {{-- Second Item --}}
                            <div class="col-md-6">

                                <div class="form-group row custom_form_group{{ $errors->has('doNO') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">DO No:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" name="doNO" value="{{ old('doNO') }}" placeholder="Input DO No">
                                      @if ($errors->has('doNO'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('doNO') }}</strong>
                                      </span>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('TruckNo') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Truck No:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="TruckNo" value="{{ old('TruckNo') }}" placeholder="Input Truck No">
                                        @if ($errors->has('TruckNo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('TruckNo') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('PurchaseDate') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Purchase Date:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control" name="PurchaseDate" value="{{ old('PurchaseDate') }}">
                                        @if ($errors->has('PurchaseDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('PurchaseDate') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row custom_form_group{{ $errors->has('VendorName') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Vendor Name:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="VendorName" id="VendorName">
                                            <option value="">Select Vendor </option>
                                            @foreach ($vendorList as $vendor)
                                              <option value="{{ $vendor->VendId }}"> {{ $vendor->VendName }} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('VendorName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('VendorName') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group row custom_form_group{{ $errors->has('Credit') ? ' has-error' : '' }}">
                                    <label class="col-sm-5 control-label">Credit Form:<span class="req_star">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="Credit" id="Credit">
                                            <option value="">Select Credit</option>
                                        </select>
                                        @if ($errors->has('Credit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Credit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div> --}}



                            </div>
                        </div>
                        {{-- second row --}}
                        <div class="row">
                          <div class="col-md-12">
                            <div class="SecondPart__Child">
                              <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                  {{-- row --}}
                                  <div class="row">
                                    <div class="col-md-2">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Select</label>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Direct Retail</label>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Direct Whole Sale</label>
                                      </div>
                                    </div>
                                  </div>
                                  {{-- row --}}
                                  <div class="row">
                                    <div class="col-md-12">

                                      <div class="form-group row custom_form_group" style="margin-top: 10px">
                                          <div class="col-sm-7">
                                              <select class="form-control" name="VendorId" id="VendorId">
                                                  <option value="1">Wholesaler</option>
                                                  <option value="2">Retailer</option>
                                              </select>
                                          </div>
                                      </div>


                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-1"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div style="margin: 0; text-align:center">
                              <button type="submit" class="btn btn-primary waves-effect">SAVE</button>
                            </div>
                          </div>

                        </div>
                       </form>
                    </div>
                </div>

            </div>
            {{-- Order Wise Product List --}}
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Order List</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered responsive mb-0">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Size</th>
                                                <th>Thickness</th>
                                                <th>Rate & Qunatity</th>
                                                <th>Amount</th>
                                                <th>Qunatity</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addToCartOrderList">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>

    </div>
    {{-- list --}}
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








@endsection
