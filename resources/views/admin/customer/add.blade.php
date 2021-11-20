@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->

  <form class="form-horizontal" id="registration" method="post" action="{{ (@$data)?route('customer.update') : route('customer.store') }}" enctype="multipart/form-data">
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

                    <div class="form-group row custom_form_group{{ $errors->has('CustName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" placeholder="Customer Name" class="form-control" id="CustName" name="CustName" value="{{(@$data)?@$data->CustName:old('CustName')}}" required>
                          <input type="hidden" name="CustId" value="{{@$data->CustId ?? ''}}">
                          @if ($errors->has('CustName'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('CustName') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('TradeName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Trade Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Trade Name" class="form-control" id="TradeName" name="TradeName" value="{{(@$data)?@$data->TradeName:old('TradeName')}}" required>
                        @if ($errors->has('TradeName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('TradeName') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ContactNumber') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Contact Number:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                            <input type="hidden" name="VendId" value="{{@$data->VendId ?? ''}}">
                            <input type="text" placeholder="Contact Number" class="form-control" id="ContactNumber" name="ContactNumber" value="{{(@$data)?@$data->ContactNumber:old('ContactNumber')}}" required>
                        @if ($errors->has('ContactNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ContactNumber') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('FatherName') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Father Name:<span class="req_star">*</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Father Name" class="form-control" id="FatherName" name="FatherName" value="{{(@$data)?@$data->FatherName:old('FatherName')}}" required>
                        @if ($errors->has('FatherName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('FatherName') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('NID') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">NID NO. :</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="NID NO." class="form-control" name="NID" value="{{(@$data)? @$data->NID:old('NID')}}" required autocomplete="off">
                        @if ($errors->has('NID'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('NID') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('DueAmount') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Due Amount :</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Due Amount is 0.00 TK" class="form-control" id="DueAmount" name="DueAmount" value="{{(@$data)?@$data->DueAmount:old('DueAmount')}}" required>
                        @if ($errors->has('DueAmount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('DueAmount') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('InitialDue') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Initial Due Balance:</label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Initial Balance is 0.00 TK" class="form-control" id="InitialDue" name="InitialDue" value="{{(@$data)?@$data->InitialDue:old('InitialDue')}}" required>
                        @if ($errors->has('InitialDue'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('InitialDue') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                </div>

                  
                <div class="col-md-6">
                    <div class="form-group row custom_form_group{{ $errors->has('CustTypeId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Customer Type :</span></label>
                        <div class="col-sm-7">
                            <select class="form-control" name="CustTypeId" id="CustTypeId">
                                <option value="">Select category</option>
                                <option value="1">Wholesaler</option>
                                <option value="2">Retailer</option>
                            </select>
                            @if ($errors->has('CustTypeId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('CustTypeId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('DiviId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Division :</span></label>
                        <div class="col-sm-7">
                            <select class="form-control" name="DiviId" id="DiviId">
                                <option value="">Select Division</option>
                                <option value="1">Dhaka</option>
                                <option value="2">Mymensingh</option>
                            </select>
                            @if ($errors->has('DiviId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('DiviId') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">District :</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="DistId" id="DistId">
                                <option value="">Select District</option>
                                <option value="1">Mymensingh</option>
                                <option value="2">Netrokona</option>
                            </select>
                            @if ($errors->has('DistId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('DistId') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ThanId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Thana :</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="ThanId" id="ThanId">
                                <option value="">Select Thana</option>
                                <option value="1">Dhanmondi</option>
                                <option value="2">Uttora</option>
                            </select>
                            @if ($errors->has('ThanId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ThanId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('UnioId') ? ' has-error' : '' }}">
                         <label class="col-sm-3 control-label">Union :</span></label>
                         <div class="col-sm-7">
                          <input type="text" placeholder="Vendor UnioId" class="form-control" id="UnioId" name="UnioId" value="{{(@$data)?@$data->UnioId:old('UnioId')}}" required>
                            @if ($errors->has('UnioId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('UnioId') }}</strong>
                                </span>
                            @endif
                         </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('Address') ? ' has-error' : '' }}">
                         <label class="col-sm-3 control-label">Address :</span></label>
                        <div class="col-sm-7">
                        <input type="text" placeholder="Vendor Address" class="form-control" id="Address" name="Address" value="{{(@$data)?@$data->Address:old('Address')}}" required>
                            @if ($errors->has('Address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
                        </div>
                     </div>
                    <div class="form-group row custom_form_group{{ $errors->has('Photo') ? ' has-error' : '' }}">
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
                    </div>


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
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>

                                            <th>SL NO.</th>
                                            <th>Customer</th>
                                            <th>Father</th>
                                            <th>TradeName</th>
                                            <th>ContactNumber</th>
                                            <th>Address</th>
                                            <th>DueAmount</th>
                                            <th>InitialDue</th>
                                            <th>NID</th>
                                            <th>Photo</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $customer->CustName ??'' }}</td>
                                            <td>{{ $customer->FatherName ??'' }}</td>
                                            <td>{{ $customer->TradeName ??'' }}</td>
                                            <td>{{ $customer->ContactNumber ??'' }}</td>
                                            <td>{{ $customer->Address ??'' }}</td>
                                            <td>{{ $customer->DueAmount ??'' }}</td>
                                            <td>{{ $customer->InitialDue ??'' }}</td>
                                            <td>{{ $customer->NID ??'' }}</td>
                                            <td>
                                                <img height="40" src="{{ asset('uploads/customer/'.$customer->Photo) }}" alt="">
                                            </td>
                                            <td>
                                                <a href="#" title="view"><i class="fa fa-plus-square fa-lg view_icon"></i></a>
                                                <a href="{{ route('customer.edit',$customer->CustId) }}" title="edit"><i class="fa fa-pencil-square fa-lg edit_icon">Edit</i></a>
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
