@extends('layouts.admin')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Starlight</a>
    <span class="breadcrumb-item active">Payment Info</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('update-customer.payment') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title"> Update Payment Information</h3>
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

                       <div class="form-group row custom_form_group{{ $errors->has('Customer') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Amount:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control"  value="{{$payInfo->Customer->CustName}}" disabled>
                              <input type="hidden" name="Customer" value="{{$payInfo->CustId}}">
                            </div>
                        </div>

                        <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Vouchar No:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" placeholder="Vouchar No" class="form-control" id="VoucharNo" name="VoucharNo" value="{{(@$payInfo)?@$payInfo->VoucharNo:old('VoucharNo')}}" required>
                              <input type="hidden" name="CustPaymId" value="{{$payInfo->CustPaymId}}">
                             
                              @if ($errors->has('VoucharNo'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('VoucharNo') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('PayAmount') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Amount:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" placeholder="PayAmount" class="form-control" name="PayAmount" value="{{$payInfo->PaymentAmount}}" required>
                              @if ($errors->has('PayAmount'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('PayAmount') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Discount:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <input type="text" placeholder="Discount" class="form-control" id="Discount" name="Discount" value="{{(@$payInfo)?@$payInfo->Discount:old('Discount')}}" required>
                              @if ($errors->has('Discount'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('Discount') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('collected') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Collected by:<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                              <select class="form-control" name="MoneyReciveBy">
                                <option value=""> Selecte Name</option>
                                <option value="1"> 1 Name</option>
                                <option value="2"> 2 Name</option>
                                <option value="3"> 3 Name</option>
                              
                              </select>
                             
                            </div>
                        </div>
                        <div class="form-group row custom_form_group{{ $errors->has('PaymentDate') ? ' has-error' : '' }}">
                            <label class="col-sm-3 control-label">Date:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" id="datepicker" name="PaymentDate" value="{{(@$payInfo)? date('d-F-Y',strtotime(@$payInfo->PaymentDate)):date('m-d-Y',strtotime(Carbon\Carbon::now())) }}" required autocomplete="off">
                            @if ($errors->has('PaymentDate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('PaymentDate') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                  </div>
                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">{{ (@$payInfo)?'UPDATE':'SAVE' }}</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

  </div>


@endsection
