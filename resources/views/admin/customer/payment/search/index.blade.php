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
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <form class="form-horizontal" id="registration" method="post" action="{{ route('payment.customer.search') }}" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-md-12">
                              <h3 class="card-title card_top_title">{{ (@$data)?'Update':'New' }} Customer Information</h3>
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

                    <div class="form-group row custom_form_group" style="align-items:center">
                        <label class="col-sm-3 control-label">Customer Type:<span class="req_star">*</span></label>
                        <div class="col-sm-4">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="type" value="1" id="btnradio1" autocomplete="off" {{$allCustomer[0]->CustTypeId==1? 'checked': ''}}>
                            <label class="btn" for="btnradio1"> Whole Seller</label>

                            <input type="radio" class="btn-check" name="type" value="2" id="btnradio2" autocomplete="off" {{$allCustomer[0]->CustTypeId==2? 'checked': ''}}>
                            <label class="btn" for="btnradio2">Retailer</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row custom_form_group{{ $errors->has('DistId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">District:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="DistId" id="DistId">
                                <option value="">Select District</option>
                                @foreach($allDistrict as $district)
                                <option value="{{$district->DistId}}">{{$district->DistName}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('DistId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('DistId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row custom_form_group{{ $errors->has('ThanId') ? ' has-error' : '' }}">
                        <label class="col-sm-3 control-label">Thana:</span></label>
                        <div class="col-sm-7">

                            <select class="form-control" name="ThanId" id="ThanId">
                                <option value="">Select Thana</option>
                                <option value="{{@$data->ThanId}}">{{@$data->Thana->ThanaName ??''}}</option>
                            </select>
                            @if ($errors->has('ThanId'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ThanId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                  </div>
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
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title card_top_title"></i>Customer List</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- <table id="alltableinfo" class="table table-bordered custom_table mb-0"> -->
                                <table id="datatable1" class="table responsive mb-0">
                                    <thead>
                                        <tr>

                                            <th>SL NO.</th>
                                            <th>Customer type</th>
                                            <th>District</th>
                                            <th>Thana</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($allCustomer as $key=>$customer)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td>{{$customer->CustomerType->TypeName}}</td>
                                            <td>{{$customer->Distict->DistName}}</td>
                                            <td>{{$customer->Thana->ThanaName}}</td>
                                            <td>{{$customer->CustName}}</td>
                                            <td>{{$customer->ContactNumber}}</td>
                                            <td>
                                            <button class="btn btn-md btn-primary waves-effect card_top_button" id="addPayment" data-toggle="modal" data-target="#AddNewPayment" data-id="{{$customer->CustId }}"><i class="fa fa-plus-circle mr-2"></i>Add Payment</button>
                                                <a class="btn btn-md btn-info waves-effect" href="{{ route('payment.info.view.customer',$customer->CustId ) }}" target="_blank" title="Record">Payment Record</a>
                                                <a class="btn btn-md btn-success waves-effect" href="{{ route('customer.wise.sell.info',$customer->CustId ) }}" target="_blank" title="Record">Sell Details</a>
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
