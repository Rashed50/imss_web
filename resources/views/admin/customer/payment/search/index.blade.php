@extends('layouts.admin')
@section('content')


<!-- ########## START: MAIN PANEL ########## -->

  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="index.html">Starlight</a>
    <span class="breadcrumb-item active">Dashboard</span>
  </nav>

  <div class="sl-pagebody">
    <!-- form -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h6>Searching Customer Payment Record</h6>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('payment.customer.search') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
               
                  @include('layouts.includes.customer-search')

                  <div class="card-footer card_footer_button text-center">
                      <button type="submit" id="onSubmit" onclick="formValidation();" class="btn btn-primary waves-effect">SEARCH</button>
                  </div>
              </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <!-- list -->
    <div class="row" style="margin-top:30px">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="dtHorizontalExample" class="custom_table table table-striped table-bordered table-sm mb-0" cellspacing="0"width="100%">
                                    <thead>
                                        <tr>
                                           <th>S.N</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Trade</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{substr($customer->CustomerType->TypeName,0,1) }}</td>
                                            <td>{{ $customer->CustName ??'' }}</td>
                                            <td>{{ $customer->TradeName ??'' }}</td>
                                            <td>{{ $customer->ContactNumber ??'' }}</td>
                                            <td>{{ $customer->Address ??'' }}</td>
                                            <td>{{ $customer->DueAmount ??'' }}</td>
                                                                                     
                                            <td>
                                            <button class="btn btn-md btn-primary waves-effect card_top_button" id="addPayment" data-toggle="modal" data-target="#AddNewPayment" title="Add Payment" data-trade="{{$customer->TradeName}}" data-phone="{{$customer->ContactNumber}}" data-name="{{$customer->CustName}}" data-customer_amount="{{$customer->DueAmount}}" data-id="{{$customer->CustId }}"><i class="fa fa-plus-circle mr-2"></i> <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                                <a class="btn btn-md btn-info waves-effect" href="{{ route('payment.info.view.customer',$customer->CustId ) }}" title="Payment Record"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> <i class="fa fa-eye" aria-hidden="true"></i></a>
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


    <!-- Modal -->
    <div id="AddNewPayment" class="modal fade">
    <div class="modal-dialog modal-lg" role="document" style="width:600px!important">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Customer Payment Information</h6>
            </div>
            <div class="modal-body pd-20">

              <div class="card pd-20 pd-sm-40 form-layout form-layout-5 modal_card">
                <form class="" action="{{ route('payment.customer.store') }}" method="post">
                    @csrf
                  {{-- input element --}}

                  <input type="hidden" id="modal_id" name="modal_id">
                
                  <div class="form-group row custom_form_group">
                     <strong>Name: </strong> <strong id="custName"></strong>
                  </div>
                  <div class="form-group row custom_form_group">
                     <strong>Trade: </strong> <strong id="tradeName"></strong>
                  </div>
                  <div class="form-group row custom_form_group">
                     <strong>Phone: </strong> <strong id="custPhone"></strong>
                  </div>
                  <div class="form-group row custom_form_group">
                      <label class="col-sm-4 control-label">Due</label>
                      <div class="col-sm-7">
                      <input type="text" class="form-control" id="DueAmount" name="DueAmount" value="" disabled>
                      </div>
                  </div>
                  
                  <div class="form-group row custom_form_group{{ $errors->has('VoucharNo') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Vouchar No:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="text" placeholder="VoucharNo" class="form-control" id="VoucharNo" name="VoucharNo" value="{{ old('VoucharNo') }}" required>
                      @if ($errors->has('VoucharNo'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('VoucharNo') }}</strong>
                          </span>
                      @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('Amount') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Amount:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="text" placeholder="Amount" class="form-control" id="Amount" name="Amount" value="{{ old('Amount') }}" required>
                      @if ($errors->has('Amount'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Amount') }}</strong>
                          </span>
                      @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('Discount') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Discount:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="text" placeholder="Discount" class="form-control" id="Discount" name="Discount" value="{{ old('Discount') }}">
                      @if ($errors->has('Discount'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Discount') }}</strong>
                          </span>
                      @endif
                      </div>
                  </div>

                  <div class="form-group row custom_form_group {{ $errors->has('Date') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Date:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                      <input type="date" class="form-control" id="Date" name="Date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      @if ($errors->has('Date'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('Date') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row custom_form_group{{ $errors->has('CreditedFromId') ? ' has-error' : '' }}">
                      <label class="col-sm-4 control-label">Creditted From:<span class="req_star">*</span></label>
                      <div class="col-sm-7">
                        <select class="form-control" name="CreditedFromId" required>
                          <option value="">Select Here</option>
                          <option value="1"> Here 1</option>
                          <option value="2"> Here 2</option>
                        </select>
                        @if ($errors->has('CreditedFromId'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('CreditedFromId') }}</strong>
                            </span>
                        @endif
                      </div>
                  </div>
                  {{-- input element --}}
                
              </div>
            </div>
            <!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">SAVE</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Cencel</button>
            </div>
            </form>
        </div>
    </div>
  </div>

<!-- Modal -->
@endsection
